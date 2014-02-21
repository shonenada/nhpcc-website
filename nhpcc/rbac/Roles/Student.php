<?php

namespace RBAC\Roles;
use RBAC\Role;

class Student extends NormalUser {

    protected $roleName = "Student";
    protected $parentName = "User";

    public function getRoleName() {
        return $this->roleName;
    }

    public function getParentName() {
        return $this->parentName;
    }

    public function authenticate(\Model\User $user=null) {
        return $user != null && $user->getLevel() >= 3;
    }

}
