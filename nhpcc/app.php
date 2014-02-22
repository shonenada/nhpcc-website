<?php

require_once(APPROOT . 'utils.php');
require_once(APPROOT . 'extensions.php');
require_once(APPROOT . 'hook.php');

// Require all controllers. But some controllers need to be merged or removed
$controllers = array (
    'home_app' => require_controller('master/home'),
    'article_app' => require_controller('articles'),
    'overview_app' => require_controller('overview'),
    'projects_app' => require_controller('projects'),
    'research_app' => require_controller('research'),
    'achievements_app' => require_controller('achievements'),
    'download_app' => require_controller('download'),
    'exchange_app' => require_controller('exchange'),
    'finding_app' => require_controller('finding'),
    'foundation_app' => require_controller('foundation'),
    'rules_app' => require_controller('rules'),
    'train_app' => require_controller('train'),
    'user_app' => require_controller('user'),
    'admin_user_app' => require_controller('master/admin_account'),
    'admin_article_app' => require_controller('master/admin_article'),
    'admin_slider_app' => require_controller('master/admin_slider'),
);

// Create app using factory.
function create_app ($config_files=array()) {

    global $controllers;
    extract($controllers);

    $config = require_once(APPROOT . 'config/config.php');

    $app = new Slimx();
    $app->config($config);
    if (isset($config_files)){
        foreach($config_files as $cfil){
            $app->config(require_once($cfil));
        }
    }

    setup_hooks($app);
    setup_views($app);

    $app->register_controller($home_app);
    $app->register_controller($article_app);
    $app->register_controller($overview_app);
    $app->register_controller($projects_app);
    $app->register_controller($research_app);
    $app->register_controller($achievements_app);
    $app->register_controller($download_app);
    $app->register_controller($exchange_app);
    $app->register_controller($finding_app);
    $app->register_controller($foundation_app);
    $app->register_controller($rules_app);
    $app->register_controller($train_app);
    $app->register_controller($user_app);
    $app->register_controller($admin_user_app);
    $app->register_controller($admin_article_app);
    $app->register_controller($admin_slider_app);

    return $app;
}
