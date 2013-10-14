<?php

function setup_views($app){
    $view = $app->view();

    $view_options = require_once(APPROOT. 'config/views.php');
    $view->parserOptions = $view_options;

    $view->parserExtensions = array(
        new \Slim\Views\TwigExtension(),
    );   
}
