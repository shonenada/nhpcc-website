<?php

use \Utils;

return array(
    "export" => function($app) {

        $cat = Utils::loadStaticContent('categories', true)->getContent();
        $research = Utils::loadStaticContent('research', true)->getContent();

        $app->get("/research", function() use ($app, $cat) {
            return $app->redirect("/research/system");
        });

        $app->get("/research/system", function() use ($app, $cat, $research) {
            $nav = $cat['research'];
            return $app->render("research/system.html", get_defined_vars());
        });
        $app->get("/research/theory", function() use ($app, $cat, $research) {
            $nav = $cat['research'];
            return $app->render("research/theory.html", get_defined_vars());
        });
        $app->get("/research/security", function() use ($app, $cat, $research) {
            $nav = $cat['research'];
            return $app->render("research/security.html", get_defined_vars());
        });
        $app->get("/research/sustain", function() use ($app, $cat, $research) {
            $nav = $cat['research'];
            return $app->render("research/sustain.html", get_defined_vars());
        });
    }
);
