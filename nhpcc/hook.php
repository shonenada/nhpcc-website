<?php

function setup_hooks($app){
    $app->hook("slim.before.router", function() use($app){
        $userCookie = $app->getCookie("user_id");
        $app->environment['user'] = $userCookie;
    });

    $app->hook("slim.before.dispatch", function() use ($app){
        $resource = $app->request->getPath();
        $user = $app->environment['user'];
        $method = $app->request->getMethod();

        require_once(APPROOT. "rbac/authenticate.php");
        $ptable = require(APPROOT. "config/permissions.php");
        $auth = new Authentication();
        $auth->load($ptable);
        if (!$auth->accessiable($user, $resource, $method)){
            $app->halt(403, "You have no permission!");
        }
        $app->environment['auth'] = $auth;

    });
}
