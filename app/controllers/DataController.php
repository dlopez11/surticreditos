<?php

class DataController extends ControllerBase
{
    public function getAction($id)
    {
        $user = $this->user->idUser;
        
        $buy = Buy::findFirst(array(
            'conditions' => 'idBuy = ?1 AND idUser = ?2',
            'bind' => array(1 => $id,
                            2 => $user)
        ));
        
        if(!$buy){
            return $this->set_json_response(array('El credito no pertenece al usuario que esta en sesión'), 404);
        }
        else{
            $rec = array();
            
            $payment = Payment::find(array(
                'conditions' => 'idBuy = ?1',
                'bind' => array(1 => $id)
            ));
            
            if (count($payment) > 0) {
                foreach ($payment as $p) {
                    $array = array();
                    $array['id'] = $p->idPayment;
                    $array['value'] = '$' . number_format($p->receiptValue);
                    $array['date'] = $p->date;
                    
                    $rec[] = $array;
                }
            }
            
            $datos = array(
                'code' => $buy->idBuy,
                'value' => '$' . number_format($buy->value),
                'dif' => '$' . number_format($buy->value - $buy->debt),
                'debt' => '$' . number_format($buy->debt)
            );
            
            
            $data = array($datos, $rec);
            
            return $this->set_json_response($data, 200);
        }
    }
}