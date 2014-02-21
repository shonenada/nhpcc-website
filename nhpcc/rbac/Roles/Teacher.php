<?php

namespace RBAC\Roles;
use RBAC\Role;

class Teacher extends NormalUser {

    protected $roleName = "Teacher";
    protected $parentName = "NormalUser";

    public function getRoleName() {
        return $this->roleName;
    }

    public function getParentName() {
        return $this->parentName;
    }

    public function authenticate(\Model\User $user=null) {
        return $user != null && $user->getLevel() >= 5;
    }
}
