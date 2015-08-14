<?php

class Tmpreport extends Phalcon\Mvc\Model
{
    public $idUser;
    
    public function initialize()
    {
        $this->belongsTo("idUser", "User", "idUser", array(
            "foreignKey" => true,
        ));
    }
}