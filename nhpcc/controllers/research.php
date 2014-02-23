<?php

use \Utils;

return array(
    "export" => function($app) {

        $cat = Utils::loadStaticContent('category', true)->getContent();
        $research = Utils::loadStaticContent('research', true)->getContent();

        $app->get("/research", function() use ($app, $cat) {
            return $app->redirect("/research/system");
        });

        $app->get('/research/:type', function ($type) use ($app, $cat, $research) {
            $nav = $cat['research'];
            $article = $research[$type];
            return $app->render('research.html', get_defined_vars());
        })->conditions(array('type' => 'system|theory|security|sustain'));

    }
);
