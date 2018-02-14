<h1>Add Post</h1>
<?= $this->Form->create() ?>
<?= $this->Form->control('title') ?>
<?= $this->Form->control('content') ?>
<?= $this->Form->button('Post') ?>
<?= $this->Form->end() ?>
