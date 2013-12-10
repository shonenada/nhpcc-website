<?php
require_once(APPROOT . "models/Article.php");

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/exchange", function() use($app, $cat) {
            $nav = $cat['exchange'];
            $categories = $nav['sub'];
            $sub = array('url' => '/exchange', 'title' => '文章列表');
            $act = Article::getSpecList(Article::getCat("EXCHANGE_ACTIVATY"), 1 ,10);
            $reports = Article::getSpecList(Article::getCat("EXCHANGE_REPORT"), 1 ,10);
            $arts = array_unique(array_merge($act, $reports));
            $app->render("exchange/index.html", get_defined_vars());
        });

        $app->get("/exchange/activities", function() use($app, $cat) {
            $nav = $cat['exchange'];
            $categories = $nav['sub'];
            $sub = $categories['activities'];
            $arts = Article::getSpecList(Article::getCat("EXCHANGE_ACTIVATY"), 1 ,10);
            $app->render("exchange/subpage.html", get_defined_vars());
        });

        $app->get("/exchange/reports", function() use($app, $cat) {
            $nav = $cat['exchange'];
            $categories = $nav['sub'];
            $sub = $categories['reports'];
            $arts = Article::getSpecList(Article::getCat("EXCHANGE_REPORT"), 1 ,10);
            $app->render("exchange/subpage.html", get_defined_vars());
        });

        $app->get("/exchange/:id", function($id) use($app, $cat) {
            $nav = $cat['exchange'];
            $categories = $nav['sub'];
            $article = Article::find($id);
            $app->render("sub.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));

    }
);
