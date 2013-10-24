<?php

require_once(APPROOT. "rbac/role.php");

class EveryOne implements Role{

    private $roleName = "EveryOne";

    private $parentName = null;

    public function getParentName(){
        return $this->parentName;
    }

    public function getRoleName(){
        return $this->roleName;
    }

    public function authenticate(User $user=null, $resource){
        return true;
    }

}
