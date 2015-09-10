<?php

class IndexController extends ControllerBase
{
    public function indexAction()
    {               
        $query = $this->modelsManager->createQuery("SELECT Buy.*, Article.* FROM Buy JOIN Article WHERE Buy.idUser = {$this->user->idUser}");
        $buys = $query->execute();
        
        $this->view->setVar("user", $this->user);
        $this->view->setVar("buys", $this->modelData($buys));
    }
    
    private function modelData($buys) 
    {
        $data = array();
        foreach ($buys as $buy) {
            if (!isset($data[$buy->buy->idBuy])) {
                $obj = new stdClass();
                $obj->idBuy = $buy->buy->idBuy;
                $obj->name = $buy->article->name;
                $obj->reference = $buy->article->reference;
                $obj->date = $buy->buy->date;
                
                $data[$buy->buy->idBuy] = $obj;
            }
            else {
                $data[$buy->buy->idBuy]->name .= ", {$buy->article->name}";
            }
        }
        
        
        return $data;
    }
}
