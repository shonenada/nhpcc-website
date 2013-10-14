<?php
if (file_exists(APPROOT. "config/production.php"))
    $env_settings = require(APPROOT. "config/production.php");
else
    $env_settings = require(APPROOT. "config/development.php");

return array_merge(
    array(
        'view' => new \Slim\Views\Twig(),
        'templates.path' => APPROOT. '/templates',
        'cookies.lifetime' => '20 minutes',
        'http.version' => '1.1',
    ),
    $env_settings);
