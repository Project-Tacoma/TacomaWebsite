<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $id
 * @property int $topic_id
 * @property int $user_id
 * @property int $post_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property int $views
 * @property int $up
 * @property int $down
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $enabled
 *
 * @property \App\Model\Entity\Topic $topic
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Post[] $posts
 */
class Post extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'topic_id' => true,
        'user_id' => true,
        'post_id' => true,
        'title' => true,
        'slug' => true,
        'content' => true,
        'views' => true,
        'up' => true,
        'down' => true,
        'created' => true,
        'modified' => true,
        'enabled' => true,
        'topic' => true,
        'user' => true,
        'posts' => true
    ];
}