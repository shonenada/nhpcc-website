<?php

function viewAddGlobal($app, $key, $value) {
    $view = $app->view();
    $twigEnv = $view->getEnvironment();
    $twigEnv->addGlobal($key, $value);
}
