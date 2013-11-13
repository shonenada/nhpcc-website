<?php

function init_controllers($app){

    $master_home = require(APPROOT. "controllers/master/home.php");
    $master_slider = require(APPROOT. "controllers/master/admin_slider.php");
    $master_account = require(APPROOT. "controllers/master/admin_account.php");
    $master_article = require(APPROOT. "controllers/master/admin_article.php");
    $article = require(APPROOT. "controllers/articles.php");
    $overview = require(APPROOT. "controllers/overview.php");
    $user = require(APPROOT. "controllers/user.php");
    $project = require(APPROOT. "controllers/projects.php");
    $research = require(APPROOT. "controllers/research.php");
    $achievements = require(APPROOT. "controllers/achievements.php");
    $exchage = require(APPROOT. "controllers/exchage.php");
    $foundation = require(APPROOT. "controllers/foundation.php");
    $train = require(APPROOT. "controllers/train.php");
    $rules = require(APPROOT. "controllers/rules.php");
    $finding = require(APPROOT. "controllers/finding.php");
    $download = require(APPROOT. "controllers/download.php");

    $controllers = array($master_home, $master_slider, $master_account,
                         $master_article, $overview, $user, $article, $project,
                         $research, $achievements, $exchage, $foundation,
                         $train, $rules, $finding, $download);
    foreach($controllers as $c){
        $func = $c['export'];
        $func($app);
    }
}
