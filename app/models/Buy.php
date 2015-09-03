<?php

class Buy extends \Phalcon\Mvc\Model
{
    public $idBuy;
    public $idUser;
    
    public function initialize()
    {
        $this->hasMany("idBuy", "Payment", "idBuy");
        $this->hasMany("idBuy", "Article", "idBuy");
        $this->belongsTo("idUser", "User", "idUser", array(
            "foreignKey" => true,
        ));
    }
}