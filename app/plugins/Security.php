<?php

use Phalcon\Events\Event,
        Phalcon\Mvc\User\Plugin,
        Phalcon\Mvc\Dispatcher,
        Phalcon\Acl;
/**
 * Security
 *
 * Este es la clase que proporciona los permisos a los usuarios. Esta clase decide si un usuario pueder hacer determinada
 * tarea basandose en el tipo de ROLE que posea
 */
class Security extends Plugin
{
    public function __construct($dependencyInjector)
    {
        $this->_dependencyInjector = $dependencyInjector;
    }

    public function getAcl()
    {
        /*
         * Buscar ACL en cache
         */
        $acl = $this->cache->get('acl-cache');

        if (!$acl) {
                // No existe, crear objeto ACL
            $acl = $this->acl;
            $roles = Role::find();
            
            //Registrando roles
            foreach ($roles as $role){
                $acl->addRole(new Phalcon\Acl\Role($role->name));
            }

            //Registrando recursos
            $resources = array(
                'dashboard' => array('read'),
                'importdata' => array('read','create','update'),
                'user' => array('read','create','update'),              
                'data' => array('read', 'download'),                
            );
            
            foreach ($resources as $resource => $actions) {
                $acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
            }
            
            // admin
            $acl->allow("admin", "dashboard", "read");           
            $acl->allow("admin", "importdata", "read");           
            $acl->allow("admin", "importdata", "create");
            $acl->allow("admin", "importdata", "update");
            $acl->allow("admin", "user", "read");
            $acl->allow("admin", "user", "create");
            $acl->allow("admin", "user", "update");
            $acl->allow("admin", "data", "read");
            $acl->allow("admin", "data", "download");
            
            // user
            $acl->allow("user", "dashboard", "read");   
            $acl->allow("user", "user", "read");
            $acl->allow("user", "user", "create");
            $acl->allow("user", "user", "update");
            $acl->allow("user", "data", "read");
            $acl->allow("user", "data", "download");

            $this->cache->save('acl-cache', $acl);
        }

        // Retornar ACL
        $this->_dependencyInjector->set('acl', $acl);
        
        return $acl;
    }

    protected function getControllerMap()
    {
        $map = $this->cache->get('controllermap-cache');
        
        if (!$map) {
            $map = array(
            /* Public resources */    
                /* Error views */
                'error::index' => array(),
                'error::notavailable' => array(),
                'error::unauthorized' => array(),
                'error::forbidden' => array(),
                'error::link' => array(),
                /* Session */
                'session::login' => array(),
                'session::logout' => array(),
                'session::recoverpass' => array(),
                'session::resetpassword' => array(),
                'session::setnewpass' => array(),
                'session::questionpass' => array(),
                'session::changepass' => array(),
                
            /* Private resources */
                /* Dashboard */
                'index::index' => array('dashboard' => array('read')),                
                /* User */                
                'user::passedit' => array('user' => array('update')),
                /* Data */                
                'data::get' => array('data' => array('read')),
                'data::create' => array('data' => array('download')),
                'data::download' => array('data' => array('download')),
                /* ImportData */                
                'importdata::index' => array('importdata' => array('read')),
                'importdata::importfileone' => array('importdata' => array('read','create','update')),
                'importdata::importfiletwo' => array('importdata' => array('read','create','update')),
                'importdata::importfilethree' => array('importdata' => array('read','create','update')),
            );
            
            $this->cache->save('controllermap-cache', $map);
        }
        
        return $map;
    }

    /**
     * This action is executed before execute any action in the application
     */
    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        $controller = \strtolower($dispatcher->getControllerName());
        $action = \strtolower($dispatcher->getActionName());
        $resource = "$controller::$action";

       
        $role = 'GUEST';
        if ($this->session->get('authenticated')) {
            $user = User::findFirstByIdUser($this->session->get('idUser'));
            if ($user) {
                $role = $user->role->name;

                $userEfective = new stdClass();
                $userEfective->enable = false;

                $efective = $this->session->get('userEfective');
                if (isset($efective)) {
                    $userEfective->enable = true;
                    $role = $efective->role->name;
                    $user->role = $efective->role;
                }
                // Inyectar el usuario
                $this->_dependencyInjector->set('userData', $user);
                $this->_dependencyInjector->set('userEfective', $userEfective);
            }
        }

        $map = $this->getControllerMap();

        $this->publicurls = array(
             /* Error views */
            'error::index',
            'error::notavailable',
            'error::unauthorized',
            'error::forbidden',
            /* Session */
            'session::login',
            'session::logout',
            'session::recoverpass',
            'session::resetpassword',
            'session::setnewpass',
            'session::questionpass',
            'session::changepass'
        );

        if ($role == 'GUEST') {
            if (!in_array($resource, $this->publicurls)) {
                $this->response->redirect("session/login");
                return false;
            }
        }
        else {
            if ($resource == 'session::login') {
                $this->response->redirect("index");
                return false;
            }
            else {
                $acl = $this->getAcl();
                $this->logger->log("Validando el usuario con rol [$role] en [$resource]");

                if (!isset($map[$resource])) {
                    $this->logger->log("El recurso no se encuentra registrado");
                    $dispatcher->forward(array('controller' => 'error', 'action' => 'index'));
                    return false;
                }

                $reg = $map[$resource];

                foreach($reg as $resources => $actions){
                    foreach ($actions as $act) {
                        if (!$acl->isAllowed($role, $resources, $act)) {
                            $this->logger->log('Acceso denegado');
                            $dispatcher->forward(array('controller' => 'error', 'action' => 'forbidden'));
                            return false;
                        }
                    }
                }

                $mapForLoginLikeAnyUser = array('session::superuser');

                if (in_array($resource, $mapForLoginLikeAnyUser)) {
                    $this->session->set('userEfective', $user);
                }

                return true;
            }
        }
    }	
}
