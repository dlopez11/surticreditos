<?php

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $buy = Buy::find(array(
            'conditions' => 'idUser = ?1',
            'bind' => array(1 => $this->user->idUser)
        ));
        
        $article = Article::find(array(
            'conditions' => 'idBuy = ?1',
            'bind' => array(1 => $buy->idBuy)
        ));
        
        $this->view->setVar("user", $this->user);
        $this->view->setVar("buys", $buy);
        $this->view->setVar("articles", $article);
    }
}
