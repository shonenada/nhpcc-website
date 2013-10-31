<?php

require_once(APPROOT. "rbac/role.php");

class EveryOne implements Role {

    protected $roleName = "EveryOne";
    protected $parentName = null;

    public function getRoleName() {
        return $this->roleName;
    }

    public function getParentName() {
        return $this->parentName;
    }

    public function authenticate(User $user=null) {
        return true;
    }

}

class NormalUser extends EveryOne {

    protected $roleName = "NormalUser";
    protected $parentName = "EveryOne";

    public function getRoleName() {
        return $this->roleName;
    }

    public function getParentName() {
        return $this->parentName;
    }

    public function authenticate(User $user=null) {
        return $user != null;
    }

}

class Student extends NormalUser {

    protected $roleName = "Student";
    protected $parentName = "User";

    public function getRoleName() {
        return $this->roleName;
    }

    public function getParentName() {
        return $this->parentName;
    }

    public function authenticate(User $user=null) {
        return $user != null && $user->getLevel() >= 3;
    }

}

class Teacher extends NormalUser {

    protected $roleName = "Teacher";
    protected $parentName = "NormalUser";

    public function getRoleName() {
        return $this->roleName;
    }

    public function getParentName() {
        return $this->parentName;
    }

    public function authenticate(User $user=null) {
        return $user != null && $user->getLevel() >= 5;
    }
}

class SuperUser extends Teacher {

    protected $roleName = "SuperUser";
    protected $parentName = "Teacher";

    public function getRoleName() {
        return $this->roleName;
    }

    public function getParentName() {
        return $this->parentName;
    }

    public function authenticate(User $user=null){
        return $user != null && $user->getLevel() >= 9;
    }
}

class Administrator extends NormalUser {

    protected $roleName = "Administrator";
    protected $parentName = "NormalUser";

    public function getParentName() {
        return $this->parentName;
    }

    public function getRoleName() {
        return $this->roleName;        
    }

    public function authenticate(User $user=null) {
        return $user != null && $user->getLevel() >= 15;
    }
}
