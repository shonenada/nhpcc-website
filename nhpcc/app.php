<?php

require_once(APPROOT. "extensions.php");
require_once(APPROOT. "controller.php");

// Create app using factory.
function create_app($config_filename="config.php"){
    $config = require_once(APPROOT. "config/". $config_filename);
    $app = new \Slim\Slim($config);

    setup_views($app);
    init_controllers($app);

    return $app;
}
