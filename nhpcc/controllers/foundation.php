<?php

require_once(APPROOT . "models/Article.php");

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/foundation", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $manage = Article::getSpecList(Article::getCat("FOUNDATION_MANAGE"), 1 ,10);
            $guide = Article::getSpecList(Article::getCat("FOUNDATION_GUIDE"), 1 ,10);
            $list = Article::getSpecList(Article::getCat("FOUNDATION_LIST"), 1 ,10);
            $contract = Article::getSpecList(Article::getCat("FOUNDATION_CONTRACT"), 1 ,10);
            $arts = array_unique(array_merge($manage, $guide, $list, $contract));
            $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/foundation/manage", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $sub = $categories['manage'];
            $arts = Article::getSpecList(Article::getCat("FOUNDATION_MANAGE"), 1 ,10);
            $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/foundation/guide", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $sub = $categories['guide'];
            $arts = Article::getSpecList(Article::getCat("FOUNDATION_GUIDE"), 1 ,10);
            $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/foundation/list", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $sub = $categories['list'];
            $arts = Article::getSpecList(Article::getCat("FOUNDATION_LIST"), 1 ,10);
            $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/foundation/contract", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $sub = $categories['contract'];
            $arts = Article::getSpecList(Article::getCat("FOUNDATION_CONTRACT"), 1 ,10);
            $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/foundation/:id", function($id) use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $article = Article::find($id);
            $app->render("sub.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));

    }
);
