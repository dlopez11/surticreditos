<?php

class DataController extends ControllerBase
{
    public function getAction($id)
    {
        $user = $this->user->idUser;
        
        $buy = Buy::find(array(
            'conditions' => 'idBuy = ?1 AND idUser = ?2',
            'bind' => array(1 => $id,
                            2 => $user)
        ));
        
        if(!$buy){
            return $this->set_json_response(array('El credito no pertenece al usuario que esta en sesión'), 404);
        }
        else{
            $datos = array(
                'valor' => $buy->value,
                'saldo' => $buy->balance
            );
            
            return $datos;
        }
    }
}