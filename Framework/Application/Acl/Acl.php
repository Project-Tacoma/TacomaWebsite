<?php
/**
*
* This class is a wrapper for the acl system
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @copyright 2016-2018 Flavio Kleiber
*/

namespace Solaria\Framework\Application\Alc;

use Samshal\Acl;
use Samshal\Acl\{
	Role\DefaultRole as Role,
	Resource\DefaultResource as Resource,
	Permission\DefaultPermission as Permission
};

class Acl {

  private $acl;

  public function __construct() {
    $this->acl = new Acl();
  }

  public function addRole($role) {
    $this->acl->add($role);
  }

}
