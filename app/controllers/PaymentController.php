<?php

class PaymentController extends ControllerBase
{
    public function indexAction($id)
    {               
        $payment = Payment::find(array(
            'conditions' => 'idBuy = ?1',
            'bind' => array(1 => $id)
        ));
        
        $query = $this->modelsManager->createQuery("SELECT Buy.*, Article.* FROM Buy JOIN Article WHERE Buy.idBuy = {$id}");
        $buys = $query->execute();
        
        $this->view->setVar("payments", $payment);
        $this->view->setVar("buys", $buys);
    }
}