<?php

function init_controllers($app){
    $master_home = require(APPROOT. "controllers/master/home.php");
    $master_slider = require(APPROOT. "controllers/master/admin_slider.php");
    $master_account = require(APPROOT. "controllers/master/admin_account.php");
    $master_article = require(APPROOT. "controllers/master/admin_article.php");
    $article = require(APPROOT. "controllers/articles.php");
    $overview = require(APPROOT. "controllers/overview.php");
    $user = require(APPROOT. "controllers/user.php");
    $controllers = array($master_home, $master_slider, $master_account, $master_article, $overview, $user, $article);
    foreach($controllers as $c){
        $func = $c['export'];
        $func($app);
    }
}
