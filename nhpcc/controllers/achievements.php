<?php

require_once(APPROOT . "models/Article.php");

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');
        $achievements = require(APPROOT. 'static_contents/achievements.php');

        $app->get("/achievements", function() use($app, $cat) {
            $app->redirect("/achievements/theies");
        });

        $app->get("/achievements/theies", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['theies'];
            $app->render("achievements/theies.html", get_defined_vars());
        });

        $app->get("/achievements/monographs", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['monographs'];
            $app->render("achievements/monographs.html", get_defined_vars());
        });

        $app->get("/achievements/awards", function() use($app, $cat, $achievements) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['awards'];
            $awards = $achievements['awards'];
            $app->render("achievements/awards.html", get_defined_vars());
        });

        $app->get("/achievements/patents", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['patents'];
            $app->render("achievements/patents.html", get_defined_vars());
        });

        $app->get("/achievements/:id", function($id) use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $article = Article::find($id);
            $app->render("sub.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));

    }
);
