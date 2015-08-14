<?php

class User extends Phalcon\Mvc\Model
{
    public $idAccount;
    public $idRole;
    public $idUser;
    
    public function initialize()
    {
        $this->hasMany("idUser", "Buy", "idUser");
        $this->hasMany("idUser", "Tmprecoverpass", "idUser");
        $this->hasMany("idUser", "Tmpreport", "idUser");
        $this->belongsTo("idRole", "Role", "idRole", array(
            "foreignKey" => true,
        ));                
    }
}