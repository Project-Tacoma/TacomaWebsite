<?php
/**
* Viewhelper, ported from the old framework
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @copyright 2016-2017 Flavio Kleiber
*/

namespace Solaria\Framework\View;
use Solaria\Framework\Core\Application;

class Tag {


    public function link_to($name, $value = "", $class="", $id="", $cssStyle='',$message=''){
        if($message != '') {
            echo '<a href="'.Application::$di->get('Url')->url.'/'.$value.'" class="'.$class.'" onclick="return confirm(\''.$message.'\')"' .$cssStyle.'>'.$name.'</a>';
        } else {
            echo '<a href="'.Application::$di->get('Url')->url.'/'.$value.'" class="'.$class.'" '.$cssStyle.'>'.$name.'</a>';
        }
    }

    public function start_link($value = "", $class="", $id="") {
        echo '<a href="'.Application::$di->get('Url')->url.'/'.$value.'" class="'.$class.'">';
    }

    public function end_link() {
        echo "</a>";
    }

    public function include_css($path) {
        echo '<link href="'.Application::$di->get('Url')->urlPath.'/'.$path.'" rel="stylesheet" />';
    }

    public function include_script($path) {
        echo '<script src="'.Application::$di->get('Url')->urlPath.'/'.$path.'"></script>';
    }

    public function include_img($path) {
      echo Application::$di->get('Url')->urlPath.'/'.$path;
    }

    public function include_content($path) {
        echo Application::$di->get('Url')->urlPath.'/'.$path.'"';
    }
    /*
    public function parserBBCode($code) {
        echo Application::singleton('Solaria\Framework\View\BBCodeParser')->parse($code);
    }

    public function countUserPosts($userId) {
        return count(Post::findBy(array('user_id' => $userId)));
    }

    public function isAllowed($resource) {
        return Application::singleton('acl')->isAllowed(Application::singleton('acl')->getRole(), $resource);
    }*/
}
