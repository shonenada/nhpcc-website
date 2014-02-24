<?php

use Model\User;
use RBAC\Authentication;

function setup_views ($app) {
    $view = $app->view();
    $view->setTemplatesDirectory($app->config('templates.path'));

    $view_options = require_once(APPROOT. 'config/views.php');
    $view->parserOptions = $view_options;

    $view->parserExtensions = array(
        new \Slim\Views\TwigExtension(),
    );

    $twigEnv = $view->getEnvironment();
    $global_vars = require_once(APPROOT. 'static_contents/twig.php');
    foreach($global_vars as $key => $value){
        $twigEnv->addGlobal($key, $value);
    }
}

function add_global_view_variable ($app, $key, $value) {
    $view = $app->view();
    $twigEnv = $view->getEnvironment();
    $twigEnv->addGlobal($key, $value);
}

function setup_hooks ($app) {
    // Hook for RBAC
    $app->hook("slim.before.router", function () use ($app){
        $salt = $app->config("salt");
        $uid = $app->getCookie("user_id");
        $token = $app->getCookie("token");
        if(isset($uid)){
            $u = User::find($uid);
            $user = User::validateToken($u, $token, $salt);
        } else {
            $user = NULL;
        }
        $app->environment['user'] = $user;
        add_global_view_variable($app, 'currentUser', $user);
    });

    $app->hook("slim.before.dispatch", function () use ($app){
        $user = $app->environment['user'];
        $resource = $app->request->getPath();
        $method = $app->request->getMethod();
        $ptable = require(APPROOT . "permissions.php");
        $auth = new Authentication();
        $auth->load($ptable);
        if (!$auth->accessiable($user, $resource, $method)) {
            $app->halt(403, "You have no permission!");
        }
    });
}
