<?php

use \Utils;
use \Model\Article;

return array(
    "export" => function($app) {

        $cat = Utils::loadStaticContent('category')->getContent();
        $achievements = require(APPROOT. 'static_contents/achievements.php');

        $app->get("/achievements", function() use($app, $cat) {
            return $app->redirect("/achievements/theies");
        });

        $app->get("/achievements/theies", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['theies'];
            return $app->render("achievements/theies.html", get_defined_vars());
        });

        $app->get("/achievements/monographs", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['monographs'];
            return $app->render("achievements/monographs.html", get_defined_vars());
        });

        $app->get("/achievements/awards", function() use($app, $cat, $achievements) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['awards'];
            $awards = $achievements['awards'];
            return $app->render("achievements/awards.html", get_defined_vars());
        });

        $app->get("/achievements/patents", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['patents'];
            return $app->render("achievements/patents.html", get_defined_vars());
        });

        $app->get("/achievements/:id", function($id) use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $article = Article::find($id);
            return $app->render("sub.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));

    }
);
