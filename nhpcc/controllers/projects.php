<?php
require_once(APPROOT . "models/User.php");
require_once(APPROOT . "models/Article.php");

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/projects", function() use($app, $cat) {
            $nav = $cat['projects'];
            $categories = $nav['sub'];
            $projects_l = Article::getSpecList(Article::getCat("PROJECT_L"), 1 ,10);
            $projects_t = Article::getSpecList(Article::getCat("PROJECT_T"), 1 ,10);
            $arts = array_unique(array_merge($projects_l, $projects_t));
            $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/projects/l", function() use($app, $cat) {
            $nav = $cat['projects'];
            $categories = $nav['sub'];
            $sub = $categories['l'];
            $arts = Article::getSpecList(Article::getCat("PROJECT_L"), 1 ,10);
            $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/projects/t", function() use($app, $cat) {
            $nav = $cat['projects'];
            $categories = $nav['sub'];
            $sub = $categories['t'];
            $arts = Article::getSpecList(Article::getCat("PROJECT_T"), 1 ,10);
            $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/projects/:id", function($id) use($app, $cat) {
            $nav = $cat['projects'];
            $categories = $nav['sub'];
            $article = Article::find($id);
            $app->render("sub.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));

    }
);
