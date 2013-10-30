<?php

require_once(APPROOT. "rbac/roles.php");
$everyone = new EveryOne();
$student = new Student();
$teacher = new Teacher();
$super = new SuperUser();
$administrator = new Administrator();

return array(
    "allow" => array(
        array($everyone, "/", "*"),
        array($everyone, "/reg", "*"),
        array($everyone, "/login", "*"),
        array($administrator, "/admin", "*"),
        array($administrator, "/admin/status", "*"),
    ),
    "deny" => array(
    )
);
