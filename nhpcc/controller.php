<?php

function init_controllers($app){
    $master = require(APPROOT. "controllers/master.php");
    $static = require(APPROOT. "controllers/user.php");
    $user = require(APPROOT. "controllers/static.php");
    $controllers = array($master, $static, $user);
    foreach($controllers as $c){
        $func = $c['export'];
        $func($app);
    }
}
