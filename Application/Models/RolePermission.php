<?php

namespace Solaria\Application\Models;

use Solaria\Framework\Application\Mvc\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="role_permission")
 **/
class RolePermission extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="integer") **/
    protected $permission_id;

    /** @Column(type="integer") **/
    protected $role_id;

    /**
     * Many Users have One UserGroupId.
     * @ManyToOne(targetEntity="Solaria\Application\Models\Role", inversedBy="rolePermission")
     * @JoinColumn(name="role_id", referencedColumnName="id")
     */
     protected $role;

     /**
      * Many Users have One UserGroupId.
      * @ManyToOne(targetEntity="Solaria\Application\Models\Permission", inversedBy="rolePermission")
      * @JoinColumn(name="permission_id", referencedColumnName="id")
      */
     protected $permission;

     public function __construct() {
       $this->permission= new ArrayCollection();
       $this->role      = new ArrayCollection();
     }

     public function getPermission() {
         return $this->permission;
     }

     public function getRole() {
         return $this->role;
     }

     public function getRoleId() {
         return $this->role_id;
     }

     public function setRole($role) {
         $this->role = $role;
     }

     public function setPermission($permission) {
         $this->permission = $permission;
     }
}
