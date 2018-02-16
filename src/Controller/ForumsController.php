<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Forums Controller
 *
 * @property \App\Model\Table\TopicsTable $Topics
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\Topic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ForumsController extends AppController
{

  public function initialize()
  {
    parent::initialize();

    $this->_permissions = [
      '*' => ['index'],
      'Admin' => ['viewPostByTopic', 'addPost'],
    ];

    $permissions = $this->_permissions['*'];

    if(!empty($this->Auth->user())) {
      foreach ($this->Auth->user('roles') as $role) {
        $permissions = $this->_permissions['*'];
        if(!empty($this->_permissions[$role['name']]) &&
        isset($this->_permissions[$role['name']]))
        {
          $permissions = array_merge($permissions, $this->_permissions[$role['name']]);
        }
      }
    }

    $this->Auth->allow($permissions);
  }

  public function index(){
    $posts = TableRegistry::get('Posts')->find('all')
                            ->where(['post_id IS ' => null])
                            ->order(['posts.created' => 'DESC'])
                            ->contain(['Users', 'Topics']);
    $userCount = TableRegistry::get('Users')->find('all')->count();
    $replies = TableRegistry::get('Posts')->find('all')->where(['post_id IS NOT' => null])->count();
    $this->set('posts', $posts);
    $this->set('userCount', $userCount);
    $this->set('replies', $replies);
  }

  public function viewPost($slug)
  {
    $postTable = TableRegistry::get('Posts');
    $post = $postTable->findBySlug($slug)->contain(['Users'])->firstOrFail();
    $replies = $postTable->find('all')->where(['post_id' => $post->id])->contain(['Users']);
    $this->set('post', $post);
    $this->set('replies', $replies);
  }

  /**
  * Adds a topic to the forum
  */
  public function addTopic()
  {
    $topicTable = TableRegistry::get('Topics');
    $topic = $topicTable->newEntity();
    if($this->request->is('post')) {
      $topic = $topicTable->patchEntity($topic, $this->request->getData());
      $topic->enabled = true;//TODO Change this here
      if($topicTable->save($topic)) {
        $this->Flash->success(__('Das Topic wurde erstellt'));
        return $this->redirect(['controller' => 'forums','action' => 'index']);
      }
      $this->Flash->error(__('Oops, wir konnten das Topic nicht erstellen'));
    }
  }

  public function addPost() {
    $postTable = TableRegistry::get('Posts');
    $post = $postTable->newEntity();
    if($this->request->is('post')) {
      $post = $postTable->patchEntity($post, $this->request->getData());
      $post->enabled = true;//TODO Change this here
      $post->user_id = $this->Auth->user('id');
      $savedPost = $postTable->save($post);
      if($savedPost) {
        $this->Flash->success(__('Das Topic wurde erstellt'));
        return $this->redirect('/forums/post/'.$savedPost->slug);
      }
      $this->Flash->error(__('Oops, wir konnten das Topic nicht erstellen'));
    }
  }

  public function viewPostByTopic($topic)
  {
    $postTable = TableRegistry::get('Posts');
    $topicTable = TableRegistry::get('Topics');

    $topic = $topicTable->findByName($topic)->firstOrFail();
    $posts = $postTable->find('all')->where(
      [
        'topic_id' => $topic->id,
        'AND' => [
          'post_id IS ' => null
          ]
      ]
    )->contain(['Users']);
    $this->set('posts', $posts);
    $this->set('topic', $topic);
  }

  public function replyPost()
  {
    $postTable = TableRegistry::get('Posts');
    $post = $postTable->newEntity();
    if($this->request->is('post')) {
      $post = $postTable->patchEntity($post, $this->request->getData());
      $post->enabled = true;//TODO Change this here
      $post->user_id = $this->Auth->user('id');
      $savedPost = $postTable->save($post);
      if($savedPost) {
        $parentPost = $postTable->findById($savedPost->post_id)->firstOrFail();
        $this->Flash->success(__('Deine Antwort wurde gespeichert'));
        return $this->redirect('/forums/post/'.$parentPost->slug);
      }
      $this->Flash->error(__('Oops, wir konnten das Topic nicht erstellen'));
    }
  }
}
