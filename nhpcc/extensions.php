<?php

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

function setup_views($app){
    $view = $app->view();
    $view->setTemplatesDirectory($app->config('templates.path'));

    $view_options = require_once(APPROOT. 'config/views.php');
    $view->parserOptions = $view_options;

    $view->parserExtensions = array(
        new \Slim\Views\TwigExtension(),
    );

    $twigEnv = $view->getEnvironment();
    $global_vars = require_once(APPROOT. 'config/twig.php');
    foreach($global_vars as $key => $value){
        $twigEnv->addGlobal($key, $value);
    }
}


function setup_database($app){
    $db_config = require(APPROOT. "config/database.php");
    $env = $app->environment();
    $config = new Configuration();
    $conn = DriverManager::getConnection($db_config, $config);
    $env['database'] = $conn;
    $app->environment = $env;
}
