<?php

namespace Solaria\Application\Models;

use Solaria\Framework\Application\Mvc\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * @Entity @Table(name="post")
 **/
class Post extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="integer") **/
    protected $topic_id;

    /** @Column(type="integer") **/
    public $user_id;

    /** @Column(type="integer") **/
    protected $post_id;

    /** @Column(type="string") **/
    public $title;

    /** @Column(type="string") **/
    public $content;

    /** @Column(type="integer") **/
    protected $views;

    /** @Column(type="integer") **/
    protected $up;

    /** @Column(type="integer") **/
    protected $down;

    /** @Column(type="datetime") **/
    protected $created;

    /** @Column(type="integer") **/
    protected $enabled;

  /**
   * Many Posts have One Topic.
   * @ManyToOne(targetEntity="Solaria\Application\Models\Topic", inversedBy="posts")
   * @JoinColumn(name="topic_id", referencedColumnName="id")
   */
   protected $topic;

   /**
    * Many Posts have One User.
    * @ManyToOne(targetEntity="Solaria\Application\Models\User")
    * @JoinColumn(name="user_id", referencedColumnName="id")
    */
    protected $user;

    /**
     * One Category has Many Categories.
     * @OneToMany(targetEntity="Solaria\Application\Models\Post", mappedBy="response")
     */
    protected $post = null;

    /**
     * Many Responses have One Post.
     * @ManyToOne(targetEntity="Solaria\Application\Models\Post", inversedBy="post")
     * @JoinColumn(name="post_id", referencedColumnName="id")
     */
    protected $response = null;

   public function __construct() {
     $this->topic = new ArrayCollection();
     $this->user = new ArrayCollection();
     $this->post = new ArrayCollection();
   }

   public function getTime($full = false) {
    $now = new DateTime;
    $ago = $this->getCreated();
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
   }

   public function getId() {
     return $this->id;
   }

   public function getResponse() {
     return $this->response;
   }

   public function getPost() {
     return $this->post;
   }

   public function getTopicId() {
     return $this->topic_id;
   }

   public function getUserId() {
     return $this->user_id;
   }

   public function getPostId() {
     return $this->post_id;
   }

   public function getTitle() {
     return $this->title;
   }

   public function getContent() {
     return $this->content;
   }

   public function getViews() {
     return $this->views;
   }

   public function getTopic() {
     return $this->topic;
   }

   public function getUser() {
     return $this->user;
   }

   public function getCreated() {
       return $this->created;
   }

   public function getUp() {
     return $this->up;
   }

   public function getDown() {
     return $this->down;
   }

   public function getEnabled() {
     return $this->enabled;
   }

   public function setTopic($topic) {
     $this->topic = $topic;
   }

   public function setUser($user) {
     $this->user = $user;
   }

   public function setTopicId($topic_id) {
     $this->topic_id = $topic_id;
   }

   public function setUserId($user_id) {
     $this->user_id = $user_id;
   }

   public function setTitle($title) {
     $this->title = $title;
   }

   public function setContent($content) {
     $this->content = $content;
   }

   public function setUp($up) {
     $this->up = $up;
   }

   public function setDown($down) {
     $this->down = $down;
   }

   public function setEnabled($enabled) {
     $this->enabled = $enabled;
   }

   public function setViews($views) {
     $this->views = $views;
   }

   public function setResponse($response) {
     $this->response = $response;
   }

}
