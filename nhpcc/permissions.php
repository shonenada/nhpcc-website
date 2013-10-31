<?php

require_once(APPROOT. "rbac/roles.php");
$everyone = new EveryOne();
$normal = new NormalUser();
$student = new Student();
$teacher = new Teacher();
$super = new SuperUser();
$administrator = new Administrator();

return array(
    "allow" => array(
        array($everyone, "/", "*"),

        array($everyone, "/reg", "GET"),
        array($everyone, "/login", "GET"),
        array($everyone, "/login", "POST"),
        array($normal, "/logout", "POST"),

        array($everyone, "/overview", "GET"),
        array($everyone, "/overview/introduction", "GET"),
        array($everyone, "/overview/team", "GET"),
        array($everyone, "/overview/team/\d+", "GET"),

        array($administrator, "/admin", "GET"),
        array($administrator, "/admin/status", "GET"),

        array($administrator, "/admin/slider", "GET"),
        array($administrator, "/admin/slider", "POST"),
        array($administrator, "/admin/slider/create", "GET"),
        array($administrator, "/admin/slider/\d+", "DELETE"),

        array($administrator, "/admin/account", "GET"),
        array($administrator, "/admin/account", "POST"),
        array($administrator, "/admin/account/create", "GET"),
        array($administrator, "/admin/account/\d+?", "GET"),
        array($administrator, "/admin/account/\d+?", "DELETE"),
        array($administrator, "/admin/account/\d+?/edit", "GET"),
        array($administrator, "/admin/account/\d+?/edit", "PUT"),

        array($administrator, "/admin/news", "GET"),
        array($administrator, "/admin/news", "POST"),
        array($administrator, "/admin/news/create", "GET"),
        array($administrator, "/admin/news/\d+?", "GET"),
        array($administrator, "/admin/news/\d+?", "DELETE"),
        array($administrator, "/admin/news/\d+?/edit", "GET"),
        array($administrator, "/admin/news/\d+?/edit", "PUT"),

    ),
    "deny" => array(
    )
);
