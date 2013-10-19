<?php

function init_controllers($app){
    $master = require(APPROOT. "controllers/master.php");
    $static = require(APPROOT. "controllers/static.php");
    $controllers = array($master, $static);
    foreach($controllers as $c){
        $func = $c['export'];
        $func($app);
    }
}
