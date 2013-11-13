<?php

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/exchange", function() use($app, $cat) {
            $nav = $cat['exchange'];
            $categories = $nav['sub'];
            $app->render("exchange/index.html", get_defined_vars());
        });

        $app->get("/exchange/activities", function() use($app, $cat) {
            $nav = $cat['exchange'];
            $categories = $nav['sub'];
            $sub = $categories['activities'];
            $app->render("exchange/subpage.html", get_defined_vars());
        });

        $app->get("/exchange/reports", function() use($app, $cat) {
            $nav = $cat['exchange'];
            $categories = $nav['sub'];
            $sub = $categories['reports'];
            $app->render("exchange/subpage.html", get_defined_vars());
        });

    }
);
