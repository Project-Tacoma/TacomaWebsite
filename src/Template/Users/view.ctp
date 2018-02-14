<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Post'), ['controller' => 'Post', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Post', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Steamid') ?></th>
            <td><?= h($user->steamid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Steamavatar') ?></th>
            <td><?= h($user->steamavatar) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Banned') ?></th>
            <td><?= h($user->banned) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= $this->Number->format($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LastActivityTime') ?></th>
            <td><?= $this->Number->format($user->lastActivityTime) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsValid') ?></th>
            <td><?= $user->isValid ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Siganture') ?></h4>
        <?= $this->Text->autoParagraph(h($user->siganture)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Post') ?></h4>
        <?php if (!empty($user->post)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Topic Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Post Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Views') ?></th>
                <th scope="col"><?= __('Up') ?></th>
                <th scope="col"><?= __('Down') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Enabled') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->post as $post): ?>
            <tr>
                <td><?= h($post->id) ?></td>
                <td><?= h($post->topic_id) ?></td>
                <td><?= h($post->user_id) ?></td>
                <td><?= h($post->post_id) ?></td>
                <td><?= h($post->title) ?></td>
                <td><?= h($post->content) ?></td>
                <td><?= h($post->views) ?></td>
                <td><?= h($post->up) ?></td>
                <td><?= h($post->down) ?></td>
                <td><?= h($post->created) ?></td>
                <td><?= h($post->enabled) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Post', 'action' => 'view', $post->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Post', 'action' => 'edit', $post->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Post', 'action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
