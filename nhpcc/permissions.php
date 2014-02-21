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
        array($everyone, "/news", "GET"),
        array($everyone, "/news/\d+", "GET"),
        array($everyone, "/annoucnt", "GET"),
        array($everyone, "/annoucnt/\d+", "GET"),

        array($everyone, "/reg", "GET"),
        array($everyone, "/login", "GET"),
        array($everyone, "/login", "POST"),
        array($normal, "/logout", "POST"),

        array($everyone, "/overview", "GET"),
        array($everyone, "/overview/introduction", "GET"),
        array($everyone, "/overview/team", "GET"),
        array($everyone, "/overview/team/\d+", "GET"),

        array($everyone, "/article/\d+", "GET"),

        array($everyone, "/research", "GET"),
        array($everyone, "/research/system", "GET"),
        array($everyone, "/research/theory", "GET"),
        array($everyone, "/research/security", "GET"),
        array($everyone, "/research/sustain", "GET"),

        array($everyone, "/projects", "GET"),
        array($everyone, "/projects/\d+", "GET"),
        array($everyone, "/projects/l", "GET"),
        array($everyone, "/projects/t", "GET"),

        array($everyone, "/achievements", "GET"),
        array($everyone, "/achievements/theies", "GET"),
        array($everyone, "/achievements/monographs", "GET"),
        array($everyone, "/achievements/awards", "GET"),
        array($everyone, "/achievements/patents", "GET"),
        array($everyone, "/achievements/\d+", "GET"),

        array($everyone, "/exchange", "GET"),
        array($everyone, "/exchange/activities", "GET"),
        array($everyone, "/exchange/reports", "GET"),
        array($everyone, "/exchange/\d+", "GET"),

        array($everyone, "/foundation", "GET"),
        array($everyone, "/foundation/manage", "GET"),
        array($everyone, "/foundation/guide", "GET"),
        array($everyone, "/foundation/funding", "GET"),
        array($everyone, "/foundation/\d+", "GET"),

        array($everyone, "/train", "GET"),
        array($everyone, "/train/teachers", "GET"),
        array($everyone, "/train/graduate", "GET"),
        array($everyone, "/train/loongson", "GET"),
        array($everyone, "/train/\d+", "GET"),

        array($everyone, "/rules", "GET"),
        array($everyone, "/rules/\d+", "GET"),
        array($everyone, "/finding", "GET"),
        array($everyone, "/finding/\d+", "GET"),
        array($everyone, "/download", "GET"),
        array($everyone, "/download/\d+", "GET"),

        array($normal, "/profile", "GET"),
        array($normal, "/profile/edit", "PUT"),


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

        array($administrator, "/admin/article", "GET"),
        array($administrator, "/admin/article", "POST"),
        array($administrator, "/admin/article/create", "GET"),
        array($administrator, "/admin/article/\d+?", "GET"),
        array($administrator, "/admin/article/\d+?", "DELETE"),
        array($administrator, "/admin/article/\d+?/edit", "GET"),
        array($administrator, "/admin/article/\d+?/edit", "PUT"),

    ),
    "deny" => array(
    )
);
