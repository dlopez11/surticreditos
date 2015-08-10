<?php

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $users = User::find(array(
            'conditions' => 'idUser = ?1',
            'bind' => array(1 => $this->user->idUser)
        ));
        
        $buy = Buy::find(array(
           'conditions' => 'idUser = ?1',
            'bind' => array(1 => $this->user->idUser)
        ));
        
        $this->view->setVar("users", $users);
        $this->view->setVar("buys", $buy);
    }
}
