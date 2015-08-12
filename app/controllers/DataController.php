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
        
        if($buy){
            
        }
    }
}