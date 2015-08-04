<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerBase
 *
 * @author Will
 */
class ControllerBase extends \Phalcon\Mvc\Controller
{
    protected $_isJsonResponse = false;

    public function initialize()
    {
//    	if (isset($this->userData)) {
            $this->user = $this->userData;
//    	}
    }
}