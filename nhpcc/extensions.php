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
    $global_vars = require_once(APPROOT. 'config/twig.php');
    foreach($global_vars as $key => $value){
        $twigEnv->addGlobal($key, $value);
    }
}


function setup_database($app){
    $db_params = require(APPROOT. "config/database.php");
    $env = $app->environment();

    $config = new Doctrine\ORM\Configuration();
    $eventManager = new Doctrine\Common\EventManager();

    $driver = $config->newDefaultAnnotationDriver(array(APPROOT. "models/"));

    $config->setMetadataDriverImpl($driver);
    $config->setProxyDir(APPROOT. 'cache/');
    $config->setProxyNamespace("nhpccProxy");

    if (extension_loaded('wincache')) {
        $config->setMetadataCacheImpl(new Doctrine\Common\Cache\WinCache());
        $config->setQueryCacheImpl(new Doctrine\Common\Cache\WinCache());
        $config->setResultCacheImpl(new Doctrine\Common\Cache\WinCache());
    } else if (extension_loaded('apc')) {
        $config->setMetadataCacheImpl(new Doctrine\Common\Cache\ApcCache());
        $config->setQueryCacheImpl(new Doctrine\Common\Cache\ApcCache());
        $config->setResultCacheImpl(new Doctrine\Common\Cache\ApcCache());
    } else {
        $config->setMetadataCacheImpl(new Doctrine\Common\Cache\ArrayCache());
    }

    $em = Doctrine\ORM\EntityManager::create($db_params, $config, $eventManager);

    $env['eventManager'] = $env['em'] = $em;
    $app->environment = $env;
}
