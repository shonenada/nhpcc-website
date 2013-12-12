<?php

require_once(APPROOT . "models/Article.php");

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');
        $achievements = require(APPROOT. 'static_contents/achievements.php');

        $app->get("/achievements", function() use($app, $cat) {
            $app->redirect("/achievements/theies");
            // $nav = $cat['achievements'];
            // $categories = $nav['sub'];
            // $thesis = Article::getSpecList(Article::getCat("ACHIE_THESIS"), 1 ,10);
            // $monograph = Article::getSpecList(Article::getCat("ACHIE_MONOGRAPH"), 1 ,10);
            // $award = Article::getSpecList(Article::getCat("ACHIE_AWARD"), 1 ,10);
            // $patent = Article::getSpecList(Article::getCat("ACHIE_PATENT"), 1 ,10);
            // $arts = array_unique(array_merge($thesis, $monograph, $award, $patent));
            // $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/achievements/theies", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['theies'];
            // $arts = Article::getSpecList(Article::getCat("ACHIE_THESIS"), 1 ,10);
            // $app->render("sub-index.html", get_defined_vars());
            $app->render("achievements/theies.html", get_defined_vars());
        });

        $app->get("/achievements/monographs", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['monographs'];
            // $arts = Article::getSpecList(Article::getCat("ACHIE_MONOGRAPH"), 1 ,10);
            // $app->render("sub-index.html", get_defined_vars());
            $app->render("achievements/monographs.html", get_defined_vars());
        });

        $app->get("/achievements/awards", function() use($app, $cat, $achievements) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['awards'];
            $awards = $achievements['awards'];
            // $arts = Article::getSpecList(Article::getCat("ACHIE_AWARD"), 1 ,10);
            // $app->render("sub-index.html", get_defined_vars());
            $app->render("achievements/awards.html", get_defined_vars());
        });

        $app->get("/achievements/patents", function() use($app, $cat) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $sub = $categories['patents'];
            // $arts = Article::getSpecList(Article::getCat("ACHIE_PATENT"), 1 ,10);
            // $app->render("sub-index.html", get_defined_vars());
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
