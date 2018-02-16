<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $steamid
 * @property string $steamavatar
 * @property string $username
 * @property string $password
 * @property string $email
 * @property bool $isValid
 * @property string $banned
 * @property \Cake\I18n\FrozenTime $created
 * @property int $lastActivityTime
 * @property string $siganture
 *
 * @property \App\Model\Entity\Post[] $post
 * @property \App\Model\Entity\UsersRole[] $users_roles
 */
class User extends Entity
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
        'steamid' => true,
        'steamavatar' => true,
        'username' => true,
        'password' => true,
        'email' => true,
        'isValid' => true,
        'banned' => true,
        'created' => true,
        'lastActivityTime' => true,
        'siganture' => true,
        'post' => true,
        'users_roles' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($value)
    {
      if(strlen($value)) {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
      }
    }
}