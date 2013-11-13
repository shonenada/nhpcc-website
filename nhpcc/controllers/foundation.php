<?php

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/foundation", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $app->render("foundation/index.html", get_defined_vars());
        });

        $app->get("/foundation/manage", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $sub = $categories['manage'];
            $app->render("foundation/subpage.html", get_defined_vars());
        });

        $app->get("/foundation/guide", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $sub = $categories['guide'];
            $app->render("foundation/subpage.html", get_defined_vars());
        });

        $app->get("/foundation/list", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $sub = $categories['list'];
            $app->render("foundation/subpage.html", get_defined_vars());
        });

        $app->get("/foundation/contract", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $sub = $categories['contract'];
            $app->render("foundation/subpage.html", get_defined_vars());
        });

    }
);
