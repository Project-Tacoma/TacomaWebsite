<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Project Tacoma - ';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <script src="//cdn.ckeditor.com/4.7.2/basic/ckeditor.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->css('font-awesome/css/fontawesome-all.min.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <?= $this->Flash->render() ?>
    <!--Start Nav-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="#">Solaria-CMS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <?=  $this->Html->link('Home', '/', ['class' => 'nav-link']) ?>
          </li>
          <li class="nav-item">
            <?=  $this->Html->link('Forum', '/forums', ['class' => 'nav-link']) ?>
          </li>
        </ul>
        <span class="navbar-text">
            <?php if(!$this->request->session()->read('Auth.User')): ?>
              <?= $this->Form->create(null, ['url' =>'/sing-in', 'class' => 'form-inline my-2 my-lg-0']) ?>
              <?= $this->Form->control('email', ['class' =>'form-control mr-sm-2', 'name' => 'email', 'placeholder' => 'Email', 'aria-label' => 'Email']) ?>
              <?= $this->Form->control('password', ['class' =>'form-control mr-sm-2', 'name' => 'password', 'placeholder' => 'Password', 'aria-label' => 'Password']) ?>
              <?= $this->Form->button('Login', ['class' => 'btn btn-outline-success my-2 my-sm-0']) ?>
              <?= $this->Form->end() ?>
            <?php else: ?>
              <p>Welcome back, <?= $this->request->session()->read('Auth.User.username') ?></p>
              <a class="btn btn-outline-danger" role="button" href="<?= $this->Url->build('/sing-out') ?>">Logout</a>
            <?php endif; ?>
       </span>
        <?=  $this->Html->link('Sing Up', '/sing-up', ['class' => 'nav-link']) ?><i class="fa fa-steam" aria-hidden="true"></i>
      </div>
    </nav>
    <!--End Nav-->
    <!--Start Content-->
    <div class="container marketing">
      <?= $this->fetch('content') ?>
    </div>
    <!--End Content-->
    <!--Start Footer-->
    <div class="fixed-bottom">
      <footer>
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2017 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>
    </div>
    <!--End Footer-->
</body>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<?= $this->fetch('script') ?>
</html>
