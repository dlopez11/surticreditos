<?php

class SessionController extends ControllerBase
{
    public function loginAction()
    {        
        if ($this->request->isPost()) {
            $msg = "Contraseña incorrecta";
            $id = $this->request->getPost("id");
            $password = $this->request->getPost("password");

            $user = User::findFirst(array(
                'conditions' => 'idUser = ?0',
                'bind' => array(0 => $id)
            ));
            
            if(!$user){
                $this->flashSession->error("Usted no se encuentra registrado en la base de datos, por favor comuniquese con Surticreditos.");
                $this->response->redirect('session/login');
            }
            else{
                if($user->status == 0 && $id == $password){
                $this->session->set('idUser', $user->idUser);
                $this->response->redirect('session/questionpass');
                }
                else{
                    if ($user && $this->hash->checkHash($password, $user->password)) {
                    $this->session->set('idUser', $user->idUser);
                    $this->session->set('authenticated', true);

                    $this->user = $user;
                    $this->trace("success", "User: {$id} login");
                    return $this->response->redirect("index");
                    }
                    else {
                        $this->trace("fail", "Access denied user: {$user->name} - {$id}, password: [{$password}]");
                        $this->flashSession->error($msg);
                        return $this->response->redirect('session/login');
                    }
                }
            }            
        }        
    }
    
    public function logoutAction()
    {
        $this->session->destroy();
        return $this->response->redirect('session/login');
    }
    
    public function recoverpassAction()
    {
        if($this->request->isPost()){
            $cedula = $this->request->getPost('cedula');
                
            $user = User::findFirst(array(
                'conditions' => 'idUser = ?1',
                'bind' => array(1 => $cedula)
            ));
            
            $this->logger->log("Toma cedula del form");
            
            try {
                if(!$user){
                    $this->flashSession->error("Usted no se encuentra registrado en la base de datos, por favor comuniquese con Surticreditos.");
                    $this->response->redirect('session/login');
                    return;
                }
                if($user->status == 0){
                    $this->flashSession->error("Esta es la primera vez que consulta su saldo, su contraseña es su número de cédula.");
                    $this->response->redirect('session/login');
                    return;
                }
                if(empty($user->email)){
                    $this->flashSession->error("Usted no tiene un correo electrónico registrado en la base de datos, por favor acérquese a la oficina de Surticréditos.");
                    $this->response->redirect('session/login');
                    return;
                }
                if($user){
                    $cod = uniqid();
                    $urlManager = $urlManager = Phalcon\DI::getDefault()->get('urlManager');
                    $url = $urlManager->get_base_uri(true);
                    $url.= 'session/resetpassword/' . $cod;
                    
                    $this->logger->log("Crea url unica");

                    $recoverObj = new Tmprecoverpass();
                    $recoverObj->idTmprecoverpass = $cod;
                    $recoverObj->idUser = $user->idUser;
                    $recoverObj->url = $url;
                    $recoverObj->date = time();
                    
                    $this->logger->log("Crea registro en la tabla Tmp");

                    if(!$recoverObj->save()){
                        foreach ($recoverObj->getMessages() as $msg){
                            throw new Exception($msg);
                        }
                    }                                        
                    else {
                        $data = new stdClass();
                        $data->fromEmail = "info@surticreditos.com";
                        $data->fromName = "Surticreditos";
                        $data->subject = "Instrucciones para recuperar la contraseña de Surticreditos";
                        $data->target = array($user->email);
                        
                        $this->logger->log("Crea objeto con asunto, remitente");
                        
                        $content = '<table style="background-color: #E6E6E6; width: 100%;"><tbody><tr><td style="padding: 20px;"><center><table style="width: 600px;" width="600px" cellspacing="0" cellpadding="0"><tbody><tr><td style="width: 100%; vertical-align: top; padding:0; background-color: #FFFFFF; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-color: #FFFFFF; border-style: none; border-width: 0px;"><table style="table-layout: fixed; width:100%; border-spacing: 0px;" width="100%" cellpadding="0"><tbody></tbody></table></td></tr><tr><td style="width: 100%; vertical-align: top; padding:0; background-color: #FFFFFF; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-color: #FFFFFF; border-style: none; border-width: 0px;"><table style="table-layout: fixed; width:100%; border-spacing: 0px;" width="100%" cellpadding="0"><tbody><tr><td style="padding-left: 0px; padding-right: 0px;"><table style="border-color: #FFFFFF; border-style: none; border-width: 0px; background-color: transparent; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; margin-top: 0px; margin-bottom: 0px; width:100%; border-spacing: 0px" cellpadding="0" width="100%"><tbody><tr><td style="width: 100%; padding-left: 0px; padding-right: 0px;" width="100%"><table style="border-color: #FFFFFF; border-style: none; border-width: 0px; background-color: transparent; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; margin-top: 0px; margin-bottom: 0px; width: 100%;" cellpadding="0" width="100%"><tbody><tr><td style="word-break: break-word; padding: 15px 15px; font-family: Helvetica, Arial, sans-serif;"><p></p><h2><span data-redactor="verified" data-redactor-inlinemethods="" style="color: rgb(227, 108, 9); font-family: Trebuchet MS, sans-serif;">Estimado usuario:</span></h2></td><td><img src="http://surticreditos.sigmamovil.com/img/Surticreditos-01.png" width="250"></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="width: 100%; vertical-align: top; padding:0; background-color: #FFFFFF; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-color: #FFFFFF; border-style: none; border-width: 0px;"><table style="table-layout: fixed; width:100%; border-spacing: 0px;" width="100%" cellpadding="0"><tbody><tr><td style="padding-left: 0px; padding-right: 0px;"><table style="border-color: #FFFFFF; border-style: none; border-width: 0px; background-color: transparent; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; margin-top: 0px; margin-bottom: 0px; width:100%; border-spacing: 0px" cellpadding="0" width="100%"><tbody><tr><td style="width: 100%; padding-left: 0px; padding-right: 0px;" width="100%"><table style="border-color: #FFFFFF; border-style: none; border-width: 0px; background-color: transparent; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; margin-top: 0px; margin-bottom: 0px; width: 100%;" cellpadding="0" width="100%"><tbody><tr><td style="word-break: break-word; padding: 15px 15px; font-family: Helvetica, Arial, sans-serif;"><p></p><p><span data-redactor="verified" data-redactor-inlinemethods="" style="font-family: Trebuchet MS, sans-serif;">Usted ha solicitado recuperar la contraseña de su usuario para ingresar a nuestra plataforma. Para finalizar este proceso, por favor, visite el siguiente enlace:</span></p></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="padding-left: 0px; padding-right: 0px;"><table style="border-color: #FFFFFF; border-style: none; border-width: 0px; background-color: transparent; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; margin-top: 0px; margin-bottom: 0px; width:100%; border-spacing: 0px" cellpadding="0" width="100%"><tbody><tr><td style="width: 100%; padding-left: 0px; padding-right: 0px;" width="100%"><table style="border-color: #FFFFFF; border-style: none; border-width: 0px; background-color: transparent; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; margin-top: 0px; margin-bottom: 0px; width: 100%;" cellpadding="0" width="100%"><tbody><tr><td style="word-break: break-word; padding: 15px 15px; font-family: Helvetica, Arial, sans-serif;"><p><span data-redactor="verified" data-redactor-inlinemethods="" style="color: rgb(54, 96, 146); font-family: Trebuchet MS, sans-serif; font-size: 18px;"><a href="tmp-url">tmp-url</a></span></p></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="padding-left: 0px; padding-right: 0px;"><table style="border-color: #FFFFFF; border-style: none; border-width: 0px; background-color: transparent; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; margin-top: 0px; margin-bottom: 0px; width:100%; border-spacing: 0px" cellpadding="0" width="100%"><tbody><tr><td style="width: 100%; padding-left: 0px; padding-right: 0px;" width="100%"><table style="border-color: #FFFFFF; border-style: none; border-width: 0px; background-color: transparent; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; margin-top: 0px; margin-bottom: 0px; width: 100%;" cellpadding="0" width="100%"><tbody><tr><td style="word-break: break-word; padding: 15px 15px; font-family: Helvetica, Arial, sans-serif;"><p></p><p><span data-redactor="verified" data-redactor-inlinemethods="" style="font-family: Trebuchet MS, sans-serif;">Si no ha solicitado ningún cambio, simplemente ignore este mensaje. Si tiene cualquier otra pregunta acerca de su cuenta, por favor, contacte a nuestro equipo de asistencia en&nbsp;</span><span style="color: rgb(227, 108, 9); font-family: Trebuchet MS, sans-serif; background-color: initial;">info@surticreditos.com</span></p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="width: 100%; vertical-align: top; padding:0; background-color: #FFFFFF; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-color: #FFFFFF; border-style: none; border-width: 0px;"><table style="table-layout: fixed; width:100%; border-spacing: 0px;" width="100%" cellpadding="0"><tbody></tbody></table></td></tr></tbody></table></center></td></tr></tbody></table>';

                        $html = str_replace("tmp-url", $url, $content);
                        $plainText = $url;
                    }

                    $mailSender = new \Surticreditos\Misc\MailSender();
                    $mailSender->setData($data);
                    $mailSender->setHtml($html);
                    $mailSender->setPlainText($plainText);
                    $mailSender->sendMessage();
                    
                    $this->logger->log("Envia correo al usuario");
                        
                    $this->trace("success", "Se han enviado instrucciones para recuperar contraseña al usuario {$user->idUser}/{$user->username} con email {$user->email} ");
                }
                else {
                    $this->trace("fail", "No se logro recuperar la contraseña del usuario [{$user->idUser}], [{$user->email}]");
                }
                
                $this->flashSession->success('Se ha enviado un correo electronico con instrucciones para recuperar la contraseña');
                return $this->response->redirect('session/login');
            } 
            catch (Exception $ex) {
                $this->trace("fail", "No se logro recuperar la contraseña del usuario [{$user->idUser}], [{$user->email}]");
                $this->logger->log("Exception while recovering password: {$ex->getMessage()}");
                $this->flashSession->error("Ha ocurrido un error, por favor contacta al administrador");
            }
        }        
    }
    
    public function resetpasswordAction($unique)
    {
        $url = Tmprecoverpass::findFirst(array(
            'conditions' => 'idTmprecoverpass = ?1',
            'bind' => array(1 => $unique)
        ));
        
        $time = strtotime("-30 minutes");
        
        if($url && ($url->date <= $time || $url->date >= $time)){
            $this->session->set('idUser', $url->idUser);
            $this->view->setVar('uniq', $unique);
        }
        else{
            $this->trace("fail","No se recupero la contraseña por que el link es invalido, no existe o expiro el ID: {$unique}");
            return $this->response->redirect('error/link');
        }
    }
    
    public function setnewpassAction()
    {
        if($this->request->isPost()){
            
            $uniq = $this->request->getPost("uniq");
            
            $url = Tmprecoverpass::findFirst(array(
                'conditions' => "idTmprecoverpass = ?1",
                'bind' => array(1 => $uniq)
            ));
            
            $time = strtotime("-30 minutes");
            
            if($url && $url->date >= $time){
                
                $pass = $this->request->getPost("pass1");
                $pass2 = $this->request->getPost("pass2");
                
                if(empty($pass) || empty($pass2)){
                    $this->flashSession->error("Ha enviado campos vacíos, por favor verifique la información");
                    $this->dispatcher->forward(array(
                        "controller" => "session",
                        "action" => "resetpassword",
                        "params" => array($uniq)
                    ));                    
                }
                else if(strlen($pass) < 8 || strlen($pass) > 40){
                    $this->flashSession->error("La contraseña es muy corta o muy larga, esta debe tener mínimo 8 y máximo 40 caracteres, por favor verifique la información");
                    $this->dispatcher->forward(array(
                        "controller" => "session",
                        "action" => "resetpassword",
                        "params" => array($uniq)
                    ));
                }
                else if($pass !== $pass2){
                    $this->flashSession->error("Las contraseñas no coinciden, por favor verifique la información");
                    $this->dispatcher->forward(array(
                        "controller" => "session",
                        "action" => "resetpassword",
                        "params" => array($uniq)
                    ));
                }
                else{
                    $idUser = $this->session->get('idUser');
                    
                    $user = User::findFirst(array(
                        'conditions' => 'idUser = ?1',
                        'bind' => array(1 => $idUser)
                    ));
                    
                    if($user){
                        $user->password = $this->security->hash($pass);
                        
                        if(!$user->save()){
                            $this->flashSession->error('Ha ocurrido un error, contacte con el administrador');
                            foreach ($user->getMessages() as $msg){
                                $this->logger->log('Error while recovering user password' . $msg);
                                $this->logger->log("User {$user->idUser}/{$user->username}");
                                $this->trace("fail","Fallo la recuperación de contraseña");
                                $this->flashSession->error('Ha ocurrido un error, por favor contacte al administrador');
                            }
                        }
                        else{
                            $idUser = $this->session->remove('idUser');
                            $url->delete();
                            $this->flashSession->success('Se ha actualizado el usuario correctamente');
                            $this->trace("success","Se recupero la contraseña del usuario {$user->idUser}/{$user->username}");
                            return $this->response->redirect('session/login');
                        }                        
                    }
                    else{
                        $this->trace("fail", "No se recupero la contraseña por que el usuario no existe");
                        return $this->response->redirect('error/link');
                    }
                }
            }
            else{
                $this->flashSession->error('No se recupero la contraseña por que el link es invalido, no existe o expiro.');
                $this->trace("fail","No se recupero la contraseña por que el link es invalido, no existe o expiro ID: {$uniq}");
                return $this->response->redirect('error/link');
            }
        }
    }
    
    public function questionpassAction()
    {
        if($this->request->isPost()){
            $phone = $this->request->getPost('phone');
            $city = $this->request->getPost('city');
            
            $infouser = User::findFirst(array(
                'conditions' => 'phone = ?1 AND city = ?2',
                'bind' => array(1 => $phone,
                                2 => $city)
            ));
            
            if($infouser){
                $this->trace("success", "User: {$infouser->idUser} answered correctly");
                return $this->response->redirect("session/changepass");
            }
            else{
                $this->flashSession->error("Sus respuestas no coinciden con la información que registra en nuestra Base de Datos, por favor validar");
                return $this->response->redirect('session/questionpass');
            }
        }
    }
    
    public function changepassAction()
    {
         if ($this->request->isPost()) {
            $pass = $this->request->getPost('password');
            $pass2 = $this->request->getPost('password2');
                        
            if(empty($pass) || empty($pass2)){
               $this->flashSession->error("Ha enviado campos vacíos, por favor verifique la información");
               $this->response->redirect('session/changepass');
           }
           else if(strlen($pass) < 8 || strlen($pass) > 40){
               $this->flashSession->error("La contraseña es muy corta o muy larga, esta debe tener mínimo 8 y máximo 40 caracteres, por favor verifique la información");
               $this->response->redirect('session/changepass');
           }
           else if($pass !== $pass2){
               $this->flashSession->error("Las contraseñas no coinciden, por favor verifique la información");
               $this->response->redirect('session/changepass');
           }
           else{
               $idUser = $this->session->get('idUser');
               
               $userinfo = User::findFirst(array(
                    'conditions' => 'idUser = ?1',
                    'bind' => array(1 => $idUser)
                ));
               
               if($userinfo){
                    $userinfo->password = $this->security->hash($pass);
                    $userinfo->status = 1;
                    $userinfo->updated = time();

                    if(!$userinfo->save()){
                        $this->flashSession->error('Ha ocurrido un error, contacte con el administrador');
                        foreach ($userinfo->getMessages() as $msg){
                            $this->logger->log('Error while recovering user password' . $msg);
                            $this->logger->log("User {$userinfo->idUser}/{$userinfo->name}");
                            $this->trace("fail","Fallo la recuperación de contraseña");
                            $this->flashSession->error('Ha ocurrido un error, por favor contacte al administrador');
                        }
                    }
                    else{
                        $idUser = $this->session->remove('idUser');
                        $this->flashSession->success('Se ha actualizado el usuario correctamente');
                        $this->trace("success","Se recupero la contraseña del usuario {$userinfo->idUser}/{$userinfo->name}");
                        return $this->response->redirect('session/login');
                    }                        
                }
                else{
                    $this->trace("fail", "No se recupero la contraseña por que el usuario no existe");
                    return $this->response->redirect('error/link');
                }
           }
       }
    }
}
