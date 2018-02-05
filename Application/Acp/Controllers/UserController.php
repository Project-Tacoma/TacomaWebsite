<?php
namespace Solaria\Application\Acp\Controllers;

use Solaria\Framework\Application\Mvc\BaseController;

use Solaria\Application\Models\User;
use Solaria\Plugins\SteamAPI\SteamAPI;
use Solaria\Application\Acp\Forms\SingUpForm;
use Doctrine\Common\Util\Debug;
//push
class UserController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->view->set('user', $this->session->get('user'));
    }

    public function profileAction($id) {
        $user = User::find($id);

        if ($user != null) {
            $this->view->set('profile_user',$user);
        } else {
            $this->di->get('SessionFlash')->error('No User found!');
            $this->response->redirect('');
        }

    }

    public function connectProfileAction($system) {
        $this->view->noRenderer();
        switch ($system) {
            case 'steam':
                $steam = new SteamAPI();;
                $steam->connect($this->session->get('user')->getId());
                break;
        }

    }

    public function singUpAction() {

        if($this->request->isPost() && $this->request->getPost() == null) {
            $user = User::findBy(
                array(
                    'username' => $this->request->getPost('username')
                )
            );
            if(count($user) != 0) {
                $this->di->get('SessionFlash')->error('User already exists!');
                $this->response->redirect('acp/user/sing-up');
            } else {
                $user = new User();
                $user->setUsername($this->request->getPost('username'));
                $user->setPassword(sha1($this->request->getPost('password')));
                $user->setEmail($this->request->getPost('email'));
                $user->setIsValid(0);
                $user->setRegisterDate(time());
                $user->setLastActivityTime(0);
                $user->setBanned('n');
                $user->setSteamId('');
                $user->setSteamAvatar('');
                $user->setIsIngame(0);
                $user->save($user);
                $this->session->set('user', $user);
                $this->di->get('SessionFlash')->success('Your user was created! You can now use it! Have fun!');
                $this->response->redirect('');
            }
        } else {
            $steam = new SteamAPI();
            $steam->run();
            $this->view->set('register_form', new SingUpForm());
        }

    }

    public function singInAction() {
      if ($this->request->isPost()) {
          $user = User::findBy(
            array(
            'username' => $this->request->getPost('username'),
            'password' => sha1($this->request->getPost('password'))
            )
          );
          if(count($user) == 0) {
              $this->di->get('SessionFlash')->error('No User found!');
              $this->response->redirect('');
          } else {
              $this->session->set('user', $user[0]);
              $this->di->get('SessionFlash')->success('Logged in!');
              $this->response->redirect('');
          }
      } else {
        $this->response->redirect('');
      }
    }

    public function singOutAction() {
        if($this->session->exist('user')) {
            $this->session->delete('user');
            $this->di->get('SessionFlash')->success('Logged out!');
            $this->response->redirect('');
        }
        $this->di->get('SessionFlash')->error('WAIT WHAT? YOU TRY TO SING OUT AND YOUR ARE NOT SING IN!');
        $this->response->redirect('');
    }

}
