<?php

function init_controllers($app){
    $master_home = require(APPROOT. "controllers/master/home.php");
    $master_account = require(APPROOT. "controllers/master/admin_account.php");
    $master_news = require(APPROOT. "controllers/master/admin_news.php");
    $static = require(APPROOT. "controllers/user.php");
    $user = require(APPROOT. "controllers/static.php");
    $controllers = array($master_home, $master_account, $master_news, $static, $user);
    foreach($controllers as $c){
        $func = $c['export'];
        $func($app);
    }
}
