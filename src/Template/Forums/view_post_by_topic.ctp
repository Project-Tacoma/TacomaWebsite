<h1><?= $topic->name ?></h1>
<?php
  foreach($posts as $post) {
    echo $post->title;
  }
?>
