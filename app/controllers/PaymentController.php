<?php

class PaymentController extends ControllerBase
{
    public function indexAction($id)
    {               
        $payment = Payment::find(array(
            'conditions' => 'idBuy = ?1',
            'bind' => array(1 => $id)
        ));
        
        $buy = Buy::find(array(
            'conditions' => 'idBuy = ?1',
            'bind' => array(1 => $id)
        ));
        
        $this->view->setVar("payments", $payment);
        $this->view->setVar("buys", $buy);
    }
}