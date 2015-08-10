<?php

class UserController extends ControllerBase
{
    public function passeditAction()
    {
        $id = $this->user->idUser;
        
        $this->logger->log($id);
        
        $edituser = User::findFirst(array(
            'conditions' => 'idUser = ?1',
            'bind' => array(1 => $id)
        ));
        
        if(!$edituser){
            $this->flashSession->error("El usuario que intenta editar no existe, por favor verifique la información");
            return $this->response->redirect("index");
        }
        
        if($this->request->isPost()){
            $pass = $this->request->getPost('pass');
            $pass2 = $this->request->getPost('pass2');
            
            if((empty($pass)||empty($pass2))){
                $this->flashSession->error('El campo contraseña esta vacío, por favor valide la información');
            }
            else if(($pass != $pass2)){
                $this->flashSession->error('Las contraseñas no coinciden');
            }
            else if(strlen($pass) < 8 || strlen($pass) > 40){
                $this->flashSession->error('La contraseña es muy corta o muy larga, esta debe tener mínimo 8 y máximo 40 caracteres, por favor verifique la información');
            }
            else{
                $edituser->password = $this->security->hash($pass);
                $edituser->updated = time();
                
                if(!$edituser->save()){
                    foreach ($edituser->getMessages() as $message) {
                        $this->flashSession->error($message);
                    }
                    $this->trace("fail","No se edito la contraseña del usuario con ID: {$edituser->idUser}");
                }
                else{
                    $this->flashSession->success('Se ha editado la contraseña exitosamente del usuario <strong>' .$edituser->name. '</strong>');
                    $this->trace("sucess","Se edito la contraseña del usuario con ID: {$edituser->idUser}");
                    return $this->response->redirect("index");
                }
            }
        }
    }
}