<?php

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/achievements", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $app->render("achievements/index.html", get_defined_vars());
        });

        $app->get("/achievements/theies", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['theies'];
            $app->render("achievements/subpage.html", get_defined_vars());
        });

        $app->get("/achievements/monographs", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['monographs'];
            $app->render("achievements/subpage.html", get_defined_vars());
        });

        $app->get("/achievements/awards", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['awards'];
            $app->render("achievements/subpage.html", get_defined_vars());
        });

        $app->get("/achievements/patents", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['patents'];
            $app->render("achievements/subpage.html", get_defined_vars());
        });

    }
);
