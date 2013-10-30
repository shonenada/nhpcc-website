<?php

interface Role{
    public function getRoleName();
    public function getParentName();
    public function authenticate(User $user=null);
}
