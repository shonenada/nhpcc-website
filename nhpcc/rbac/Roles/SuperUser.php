<?php

namespace RBAC\Roles;
use RBAC\Role;

class SuperUser extends Teacher {

    protected $roleName = "SuperUser";
    protected $parentName = "Teacher";

    public function getRoleName() {
        return $this->roleName;
    }

    public function getParentName() {
        return $this->parentName;
    }

    public function authenticate(\Model\User $user=null){
        return $user != null && $user->getLevel() >= 9;
    }
}