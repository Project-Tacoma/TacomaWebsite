<h1><?= $topic->name ?></h1>
<!-- START FORUM -->
<div class="row">
  <div class="col-md-9 col-sm-12">
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
          <span class="times-created">Created <?=  $this->Time->timeAgoInWords($post->created,['format' => 'MMM d, YYY', 'end' => '+1 year']); ?> in</span>
          <span class="type-category">
            <a href="#">
              <span class="flags color-31"></span> <?= $topic->name ?>
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
</div><!-- END FORUM -->
