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

  public function index(){
    $posts = TableRegistry::get('Posts')->find('all')->contain(['Users', 'Topics']);
    $userCount = TableRegistry::get('Users')->find('all')->count();
    $replies = TableRegistry::get('Posts')->find('all')->where(['post_id IS NOT' => null])->count();
    $this->set('posts', $posts);
    $this->set('userCount', $userCount);
    $this->set('replies', $replies);
  }

  public function viewPost($slug)
  {
    $postTable = TableRegistry::get('Posts');
    $post = $postTable->findBySlug($slug)->firstOrFail();
    $this->set('post', $post);
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
    );
    $this->set('posts', $posts);
    $this->set('topic', $topic);
  }
}
