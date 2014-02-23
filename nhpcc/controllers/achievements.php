<?php

use \Utils;

return array(
    'export' => function($app) {
        $cat = Utils::loadStaticContent('category', true)->getContent();
        $achievements = Utils::loadStaticContent('achievements', true)->getContent();

        $app->get('/achievements', function() use ($app, $cat) {
            return $app->redirect('/achievements/theies');
        });

        $app->get('/achievements/:type', function ($type) use ($app, $cat, $achievements) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories[$type];
            return $app->render("achievements/{$type}.html", get_defined_vars());
        })->conditions(array('type' => 'theies|monographs|awards|patents'));
    }
);
