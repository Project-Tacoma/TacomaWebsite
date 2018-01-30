<?php
namespace Solaria\Application\Forum\Controllers;

use Solaria\Application\Forum\Controllers\BaseController;
use Solaria\Application\Models\Topic;
use Solaria\Application\Models\Post;

class TopicController extends BaseController {

    public function indexAction($id) {
        $topic = Topic::find($id);
        if($topic == null) {
            $this->di->get('SessionFlash')->error('The topic that you requested, does not longer exist');
            $this->response->redirect('forum');
        } else {
            $this->view->set('topic', $topic);
        }
    }

}
