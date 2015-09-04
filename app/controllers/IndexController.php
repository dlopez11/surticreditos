<?php

class IndexController extends ControllerBase
{
    public function indexAction()
    {               
        $query = $this->modelsManager->createQuery("SELECT Buy.*, Article.* FROM Buy JOIN Article WHERE Buy.idUser = {$this->user->idUser}");
        $buys = $query->execute();
        
        foreach ($buys as $b) {
            $this->logger->log("x: {$b->buy->value}");
        }
        
        $this->view->setVar("user", $this->user);
        $this->view->setVar("buys", $buys);
    }
}
