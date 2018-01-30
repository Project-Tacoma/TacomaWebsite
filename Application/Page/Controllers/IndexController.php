<?php

namespace Solaria\Application\Page\Controllers;

use Solaria\Framework\Application\Mvc\BaseController;

class IndexController extends BaseController {

    public function indexAction() {
        $this->view->set('carousel', true);
        $this->view->set('user', $this->session->get('user'));
    }

}
