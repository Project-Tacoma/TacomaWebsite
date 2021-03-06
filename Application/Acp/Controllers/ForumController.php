<?php
namespace Solaria\Application\Acp\Controllers;

use Solaria\Framework\Application\Mvc\BaseController;
use Solaria\Framework\Application\Rbac\PermissionHelper;
use Solaria\Application\Models\Topic;
use Solaria\Application\Models\Permission;
use Solaria\Application\Models\RolePermission;
use Solaria\Application\Models\Role;

class ForumController extends BaseController {

    public function indexAction() {
      $this->view->set('allGroups', Role::findAll());
      $this->view->set('allForums', Topic::findAll());
    }

    public function createTopicAction() {
      if($this->request->isPost()) {
        $name = $this->request->getPost('topic_name');
        $nameCheck = Topic::findBy(array('name' => $name));
        if(count($nameCheck) == 0) {
          $topic = new Topic();
          $topic->setName($name);
          $topic->setEnabled(1);
          $this->di->get('SessionFlash')->success('Topic <b>'.$name.'</b> successfully created :)');
          $this->response->redirect('forum/topic/'.$newTopic->getId());
        } else {
          $this->di->get('SessionFlash')->error('A topic with the name <b>' . $name . '</b> allready exists!');
          $this->response->redirect('forum');
        }
      } else {
          $this->response->redirect('forum');
      }
    }

    /**
     * @AS_TODO: REFACTOR, BUT IM TOO TIRED NOW
     */
    public function editTopicAction($id){
      $topic = Topic::find($id);
      if($this->request->isPost() && $topic != null) {
        if ($topic->getName() != $this->request->getPost('topic_name')) {
          $topic->setName($this->request->getPost('topic_name'));
        }
        if(array_key_exists('active', $this->request->getPost())) {
          $topic->setEnabled(1);

          //Set all posts to visible!
          foreach ($topic->getPosts() as $post) {
            $post->setEnabled(1);
            $post->update($post);
          }

        } else {

          $topic->setEnabled(0);

          //Set all posts to invisible!
          foreach ($topic->getPosts() as $post) {
            $post->setEnabled(0);
            $post->update($post);
          }
        }


        $topic->update($topic);
        $this->di->get('SessionFlash')->success('Topic updated');
        $this->response->redirect('acp/forum/edit-topic/'.$topic->getId());
      } else {
        if($topic != null) {
          $permission = Permission::findBy(array('name' => 'Forum.topic.index.'.$topic->getId()))[0];
          $roles = Role::findAll();
          $rolesArr = array();
          $usedRoles = array();
          $rp = $permission->getRolePermission();
          foreach($rp as $rp2) {
            $usedRoles[$rp2->getRole()->getName()] = $rp2->getRole();
          }
          foreach($roles as $role) {
            if(!array_key_exists($role->getName(), $usedRoles)) {
              $rolesArr[$role->getName()] = $role;
            }
          }
          $this->view->set('topic', $topic);
          $this->view->set('roles', $rolesArr);
          $this->view->set('usedRoles', $usedRoles);
        } else {
          $this->response->redirect('acp');
        }
      }

    }

}
