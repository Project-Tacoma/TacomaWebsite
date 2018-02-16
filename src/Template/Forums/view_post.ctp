<?php
$users = [];
?>
<div class="row">
  <div class="col-md-9 title-header-wrapper">
    <div class="row">
      <div class="col-md-9 title-thread-header col-sm-9">
        <h1 class="title-thread"><?= $post->title ?></h1>
        <div class="thread-information">
            <a href="<?= $this->Url->build('/forums/topic/public') ?>">
              <span class="flags color-31"></span>
              <span class="thread-cat-name">Public</span>
            </a>
          </span>
        </div>
      </div>
    </div>
    <div class="items-thread item-thread clearfix">
      <div class="f-floatleft single-avatar">
        <a href="#">
            <img src="http://pipsum.com/64x64.jpg" alt="Avatar" class="avatar">
        </a>
      </div>
      <div class="f-floatright topic-thread">
        <div class="topic-thread">
          <div class="post-display">
            <div class="name">
              <a href="#" class="post-author"><?= $post->user->username ?></a>
              <span class="comment"><span class="icon">
                <i class="fas fa-comment"></i>
              </span> 1</span>
              <span class="like"></span>
              <span class="date"></span>
            </div>
            <div class="content">
              <?= $post->content ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php foreach($replies as $reply): ?>
      <div class="items-thread item-thread clearfix">
        <div class="f-floatleft single-avatar">
          <a href="#">
              <img src="http://pipsum.com/64x64.jpg" alt="Avatar" class="avatar">
          </a>
        </div>
        <div class="f-floatright topic-thread">
          <div class="topic-thread">
            <div class="post-display">
              <div class="name">
                <a href="#" class="post-author"><?= $reply->user->username ?></a>
                <span class="comment"><span class="icon">
                  <i class="fas fa-comment"></i>
                </span> 1</span>
                <span class="like"></span>
                <span class="date"></span>
              </div>
              <div class="content">
                <?= $reply->content ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $users[$reply->user->id] = $reply->user?>
    <?php endforeach; ?>
    <div class="items-thread item-thread clearfix">
      <div class="f-floatleft single-avatar">
        <a href="#">
            <img src="http://pipsum.com/64x64.jpg" alt="Avatar" class="avatar">
        </a>
      </div>
      <div class="f-floatright topic-thread">
        <div id="form_thread" class="" >
          <?= $this->Form->create(null, ['url' => '/forums/replyPost']) ?>
          <div class="text-search">
            <div class="input-contianer">
              <button class="btn btn-outline-success" type="button" data-toggle="collapse" data-target="#showTopic" aria-expanded="false" aria-controls="showTopic">
                Click to reply
              </button>
            </div>
            <div id="showTopic" class="collapse">
              <div class="form-group">
                <?= $this->Form->hidden('title',['value' => 'Re:'.$post->title]) ?>
              </div>
              <div class="form-group">
                <?= $this->Form->hidden('topic_id',['value' => $post->topic_id]) ?>
              </div>
              <div class="form-group">
                <?= $this->Form->hidden('post_id',['value' => $post->id]) ?>
              </div>
              <div class="form-group">
                <?= $this->Form->textarea('content',['class' => 'form-control', 'id' => 'editor1']) ?>
              </div>
                <?= $this->Form->button('Post', ['class' => 'btn btn-outline-success']) ?>
            </div>
            <?= $this->Form->end() ?>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 marginTop18 thread-discuss-right hidden-sm hidden-xs">
    <div class="widget hide-discuss-tablet who-in-discuss">
      <h2>People in the discussion</h2>
      <ul class="user-discuss">
        <?php foreach($users as $user): ?>
        <li>
          <a href="#">
            <img src="http://pipsum.com/64x64.jpg" alt="Avatar" class="img-circle">
          </a>
        </li>
      <?php endforeach;  ?>
      </ul>
    </div>
  </div>
</div>
<?= $this->cell('Bbcode') ?>
