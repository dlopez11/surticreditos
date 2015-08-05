<?php

namespace Surticreditos\Misc;

class SmartMenu extends \Phalcon\Mvc\User\Component implements \Iterator
{	
    protected $controller;

    private $_menu = array (        
        "Actualizar Información" => array(
            "controller" => array("importdata"),
            "class" => "",
            "url" => "importdata",
            "title" => "Actualizar Información",
            "icon" => "",
            "target" => ""
        ),
    );

    public function __construct() 
    {
        $this->controller =  $this->view->getControllerName();
    }


    public function get() 
    {
        return $this;
    }
	
    public function rewind()
    {
        \reset($this->_menu);
    }

    public function current()
    {
        $obj = new \stdClass();
		
        $curr = \current($this->_menu);

        $obj->title = $curr['title'];
        $obj->icon = $curr['icon'];
        $obj->url = $curr['url'];
        $obj->class = '';
        $obj->target = $curr['target'];

        if (\in_array($this->controller, $curr['controller'])) {
            $obj->class = 'active';
        }
		
        return $obj;
    }

    public function key()
    {
        return \key($this->_menu);
    }

    public function next()
    {
        $var = \next($this->_menu);
    }

    public function valid()
    {
        $key = \key($this->_menu);
        $var = ($key !== NULL && $key !== FALSE);
        return $var;
    }
}
