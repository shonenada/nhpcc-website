<?php

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/train", function() use($app, $cat) {
            $nav = $cat['train'];
            $categories = $nav['sub'];
            $app->render("train/index.html", get_defined_vars());
        });

        $app->get("/train/teachers", function() use($app, $cat) {
            $nav = $cat['train'];
            $categories = $nav['sub'];
            $sub = $categories['teachers'];
            $app->render("train/subpage.html", get_defined_vars());
        });

        $app->get("/train/graduate", function() use($app, $cat) {
            $nav = $cat['train'];
            $categories = $nav['sub'];
            $sub = $categories['graduate'];
            $app->render("train/subpage.html", get_defined_vars());
        });

        $app->get("/train/loongson", function() use($app, $cat) {
            $nav = $cat['train'];
            $categories = $nav['sub'];
            $sub = $categories['loongson'];
            $app->render("train/subpage.html", get_defined_vars());
        });

    }
);
