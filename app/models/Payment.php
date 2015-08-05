<?php

class Payment extends \Phalcon\Mvc\Model
{
    public $idBuy;

    public function initialize()
    {
        $this->belongsTo("idBuy", "Buy", "idBuy", array(
            "foreignKey" => true,
        ));
    }
}