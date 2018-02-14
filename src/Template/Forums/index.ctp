<!-- START FORUM -->
<div class="row">
  <div class="col-md-9 col-sm-12">
    <div id="form_thread" class="" >
      <?= $this->Form->create(null, ['url' => '/forums/addPost']) ?>
      <div class="text-search">
        <div class="input-contianer">
          <button class="btn btn-outline-success" type="button" data-toggle="collapse" data-target="#showTopic" aria-expanded="false" aria-controls="showTopic">
            Click to start a topic
          </button>
        </div>
        <div id="showTopic" class="collapse">
          <div class="form-group">
            <?= $this->Form->control('title',['class' => 'form-control']) ?>
          </div>
          <div class="form-group">
            <?= $this->Form->select('topic_id',[1 => 'Public' , 2 => 'Test'],['class' => 'form-control']) ?>
          </div>
          <div class="form-group">
            <?= $this->Form->textarea('content',['class' => 'form-control', 'id' => 'editor1']) ?>
          </div>
            <?= $this->Form->button('Post', ['class' => 'btn btn-outline-success']) ?>
        </div>
        <?= $this->Form->end() ?>
      </div>


    </div>
    <ul id="main_post_list" class="list-post">
      <?php foreach($posts as $post): ?>
      <li class="thread-item">
        <a href="#">
          <span class="thumb avatar">
            <img src="http://pipsum.com/64x64.jpg" alt="Avatar" class="avatar">
          </span>
        </a>
        <div class="f-floatright">
          <h2 class="title"><?=  $this->Html->link($post->title, '/forums/post/'.$post->slug) ?></h2>
        </div>
        <div class="post-information">
          <span class="times-created">Updated on January 7, 2016 in</span>
          <span class="type-category">
            <a href="#">
              <span class="flags color-31"></span> <?= $post->topic->name ?>
            </a>
          </span>
          <span class="author">
            <span class="last-reply">
              <a href="#"> Last reply</a>
            </span>
            by
            <span class="semibold">
              <a href=""><?= $post->user->username ?></a>
              .
            </span>
          </span>
          <span class="user-action">
            <span class="comment">
              <span class="icon">
                <i class="fas fa-comment"></i>
              </span>
              1
            </span>
            <span class="like">
              <span class="icon">
                <i class="fas fa-heart"></i>
              </span>
              0
            </span>
          </span>
        </div>
      </li>
      <!-- <li class="thread-item">
        <a href="#">
          <span class="thumb avatar">
            <img src="http://pipsum.com/64x64.jpg" alt="Avatar" class="avatar">
          </span>
        </a>
        <div class="f-floatright">
          <h2 class="title"><a href="#">Das ist ein sehr toller Post</a></h2>
        </div>
        <div class="post-information">
          <span class="times-created">Updated on January 7, 2016 in</span>
          <span class="type-category">
            <a href="#">
              <span class="flags color-31"></span> Server
            </a>
          </span>
          <span class="author">
            <span class="last-reply">
              <a href="#"> Last reply</a>
            </span>
            No reply yet
          </span>
          <span class="user-action">
            <span class="comment">
              <span class="icon">
                <i class="fas fa-comment"></i>
              </span>
              0
            </span>
            <span class="like">
              <span class="icon">
                <i class="fas fa-heart"></i>
              </span>
              0
            </span>
          </span>
        </div>
      </li> -->
    <?php endforeach; ?>
    </ul>
  </div>
  <div class="col-md-3 hidden-sm hidden-xs sidebar">
    <div class="widget stats-wg">
      <h2 class="widgettitle">STATS</h2>
      <div class="statistics">
        <ul>
          <li>
            <span class="number-stt"><?= $userCount ?></span>
            <span class="name-stt"> Members </span>
          </li>
          <li>
            <span class="number-stt"><?= $posts->count() ?></span>
            <span class="name-stt"> Threads </span>
          </li>
          <li>
            <span class="number-stt"><?= $replies ?></span>
            <span class="name-stt"> Repiels </span>
          </li>
        </ul>
      </div>
    </div>
    <div class="widget widget-categories">
      <ul class="category-items">
				<li id="nav_cat_2" class="">
				    <a class="cat-item " href="<?= $this->Url->build('/forums/topic/public') ?>">Public<span class="flags color-31"></span></a>
        </li>
        <li id="nav_cat_3" class="">
				    <a class="cat-item " href="<?= $this->Url->build('/forums/topic/Test') ?> ">Test<span class="flags color-30"></span></a>
        </li>
      </ul>
    </div>
  </div>
</div><!-- END FORUM -->
<?= $this->cell('Bbcode') ?>
