<?php

require_once(APPROOT . "extensions.php");
require_once(APPROOT . "hook.php");

function init_controllers($app){
    function scan_controller($path, $app){
        foreach (glob($path) as $filename){
            if (is_dir($filename)){
                scan_controller($filename . "/*", $app);
            } else {
                if (substr($filename, -3) == 'php'){
                    $export = require($filename);
                    $func = $export['export'];
                    $func($app);
                }
            }
        }
    }
    $scan_path = APPROOT . DIRECTORY_SEPARATOR . "controllers/*";
    scan_controller($scan_path, $app);
}


// Create app using factory.
function create_app($config_filename="custom.php"){

    $config = require_once(APPROOT . "config/config.php");
    $custom = require_once(APPROOT . "config/" . $config_filename);

    $app = new \Slim\Slim();
    $app->config($config);

    setup_hooks($app);
    setup_views($app);
    init_controllers($app);

    return $app;
}
