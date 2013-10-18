<?php

function setup_views($app){
    $view = $app->view();
    $view->setTemplatesDirectory($app->config('templates.path'));

    $view_options = require_once(APPROOT. 'config/views.php');
    $view->parserOptions = $view_options;

    $view->parserExtensions = array(
        new \Slim\Views\TwigExtension(),
    );

    $twigEnv = $view->getEnvironment();
    $global_vars = require_once(APPROOT. 'config/twig/global.php');
    foreach($global_vars as $key => $value){
        $twigEnv->addGlobal($key, $value);
    }
}
