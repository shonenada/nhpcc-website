<?php

use \Utils;

require_once(APPROOT . 'extensions.php');

$config = require_once(APPROOT . 'config/config.php');

// Require all controllers. But some controllers need to be merged or removed
$controllers = array (
    'home_app' => Utils::require_controller('master/home'),
    'article_app' => Utils::require_controller('articles'),
    'overview_app' => Utils::require_controller('overview'),
    'projects_app' => Utils::require_controller('projects'),
    'research_app' => Utils::require_controller('research'),
    'achievements_app' => Utils::require_controller('achievements'),
    'download_app' => Utils::require_controller('download'),
    'exchange_app' => Utils::require_controller('exchange'),
    'finding_app' => Utils::require_controller('finding'),
    'foundation_app' => Utils::require_controller('foundation'),
    'rules_app' => Utils::require_controller('rules'),
    'train_app' => Utils::require_controller('train'),
    'user_app' => Utils::require_controller('user'),
    'admin_user_app' => Utils::require_controller('master/admin_account'),
    'admin_article_app' => Utils::require_controller('master/admin_article'),
    'admin_slider_app' => Utils::require_controller('master/admin_slider'),
    'admin_static_app' => Utils::require_controller('master/admin_static'),
);

// Create app using factory.
function create_app ($config_files=array()) {
    if(!is_array($config_files))
        exit('Config Files are not array.');

    $app = new Slimx();

    global $config;
    $app->config($config);
    foreach($config_files as $cfil){
        $app->config(require_once($cfil));
    }

    setup_hooks($app);
    setup_views($app);

    // Register all controllers in global variable $controllers
    global $controllers;
    extract($controllers);

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
    $app->register_controller($admin_static_app);

    return $app;
}
