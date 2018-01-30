<?php

namespace Solaria\Application\Opl\Controllers;

use Solaria\Application\Opl\Controllers\BaseController;
use Solaria\Application\Models\User;

class IndexController extends BaseController {

    public function indexAction($id) {
      $user = User::find($id);

      if ($user != null) {
          $this->view->set('profile_user',$user);
      } else {
          $this->di->get('SessionFlash')->error('No User found!');
          $this->response->redirect('');
      }
    }

}
