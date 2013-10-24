<?php

require_once(APPROOT. "rbac/roles.php");
$everyone = new EveryOne();

return array(
    "allow" => array(
        array($everyone, "/", "GET"),
    ),
    "deny" => array(
    )
);