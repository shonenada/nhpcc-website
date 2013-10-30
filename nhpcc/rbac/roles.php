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

class Student extends EveryOne {

    protected $roleName = "Student";
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

class Teacher extends EveryOne {

    protected $roleName = "Teacher";
    protected $parentName = "EveryOne";

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

    public function getParentName(){
        return $this->parentName;
    }

    public function authenticate(User $user=null){
        return $user != null && $user->getLevel() >= 9;
    }
}

class Administrator extends EveryOne {

    protected $roleName = "Administrator";
    protected $parentName = "EveryOne";

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
