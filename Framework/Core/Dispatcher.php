<?php
/**
* Dispatcher class, dont fuck up here
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @copyright 2016-2017 Flavio Kleiber
*/

namespace Solaria\Framework\Core;

use Solaria\Framework\Core\DiClass;
use Solaria\Application\Models\User;

class Dispatcher extends DiClass {

    private $currentController;
    private $currentAction;
    private $currentModule;

    public function __construct() {
        parent::__construct();
    }

    public function dispatch($controller, $action, $arguments = array(), $module = 'Page') {
        $this->currentController = str_replace('controller', '', strtolower($controller));
        $this->currentAction = $this->from_camel_case(str_replace('Action', '', $action));
        $isGranted = false;//just for debug

        //Check guest's first
        /*
        if($this->di->get('Rbac')->isGranted('Guest', $module.'.'.$this->currentController.'.*.*') ||
          $this->di->get('Rbac')->isGranted('Guest', $module.'.'.$this->currentController.'.'.$this->currentAction) ||
          $this->di->get('Rbac')->isGranted('Guest', $module.'.'.$this->currentController.'.'.$this->currentAction.'.*'))
        {
            $isGranted = true;
            $this->run($controller, $action, $arguments, $module);

        } else if($this->di->get('Session')->exist('user')) { //Check user
          $user = User::find($this->di->get('Session')->get('user')->getId());

          foreach ($user->getUserRoles() as $roles) {
            $role = $roles->getRole();
            if($this->di->get('Rbac')->isGranted($role->getName(), $module.'.*.*.*') ||
              $this->di->get('Rbac')->isGranted($role->getName(), $module.'.'.$this->currentController.'.*') ||
              $this->di->get('Rbac')->isGranted($role->getName(), $module.'.'.$this->currentController.'.'.$this->currentAction) ||
              $this->di->get('Rbac')->isGranted($role->getName(), $module.'.'.$this->currentController.'.'.$this->currentAction.'.'.$arguments[0]))
            {
              $isGranted = true;
              break;
            }
          }

          if($isGranted) {
            $this->run($controller, $action, $arguments, $module);
          }
        }

        if(!$isGranted) {
          //throw new \Exception("NO PERMISSION!");
          //For the moment back to the home site
          $this->di->get('SessionFlash')->error('Sry but you dont have the permission');
          $this->di->get('Response')->redirect('');

        }*/
        $this->run($controller, $action, $arguments, $module);


    }

    private function run($controller, $action, $arguments, $module) {
        //add namespace
        $controller = 'Solaria\Application\\'.$module.'\Controllers\\'.$controller;
        if(class_exists($controller)) {
            if(method_exists($controller, $action)) {
                $this->di->set('Dispatcher', $this);
                $this->currentModule = $module;
                call_user_func_array(array(new $controller, $action), $arguments);
                return;
            } else {
                throw new \Exception("Method ".$action. " does not exist!");
            }
        }
        throw new \Exception("Class ".$controller. " does not exist!");
    }

    public function forward($controller, $action, $arguments = array(), $module = 'page') {
      $this->run($controller, $action, $arguments, $module);
    }

    public function getController() {
        return $this->currentController;
    }

    public function getAction() {
        return $this->currentAction;
    }

    public function getModule() {
        return $this->currentModule;
    }

    /**
    *@see http://stackoverflow.com/questions/1993721/how-to-convert-camelcase-to-camel-case
    */
    private function from_camel_case($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('-', $ret);
    }

}
