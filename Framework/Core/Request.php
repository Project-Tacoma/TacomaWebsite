<?php
/**
* Wrapper for a request
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @copyright 2016-2018 Flavio Kleiber
*/

namespace Solaria\Framework\Core;

class Request {

    public $url;

    public $arguments;

    /**
    * Check if the request is a post request
    *
    * @return bool
    */
    public function isPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }
        return false;
    }

    /**
    * Check if the request is a get request
    *
    * @return bool
    */
    public function isGet() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return true;
        }
        return false;
    }

    /**
    * Check if the request is a ajax request
    *
    * @return bool
    */
    public function isAjax() {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            return true;
        }
        return false;
    }

    /**
    * Get the content of the post array
    * if the value is empty you get the post array
    *
    * @param value string
    * @return mixed array|string
    */
    public function getPost($value='') {
        return ($value == '') ?  $_POST :  $_POST[$value];
    }

}
