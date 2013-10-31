<?php

function init_controllers($app){
    $master_home = require(APPROOT. "controllers/master/home.php");
    $admin_slider = require(APPROOT. "controllers/master/admin_slider.php");
    $master_account = require(APPROOT. "controllers/master/admin_account.php");
    $master_news = require(APPROOT. "controllers/master/admin_news.php");
    $overview = require(APPROOT. "controllers/overview.php");
    $user = require(APPROOT. "controllers/user.php");
    $controllers = array($master_home, $admin_slider, $master_account, $master_news, $overview, $user);
    foreach($controllers as $c){
        $func = $c['export'];
        $func($app);
    }
}
