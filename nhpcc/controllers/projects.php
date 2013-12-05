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
            $projects = array_unique(array_merge($projects_l, $projects_t));
            $app->render("projects/index.html", get_defined_vars());
        });

        $app->get("/projects/l", function() use($app, $cat) {
            $nav = $cat['projects'];
            $categories = $nav['sub'];
            $sub = $categories['l'];
            $projects = Article::getSpecList(Article::getCat("PROJECT_L"), 1 ,10);
            $app->render("projects/projects_l.html", get_defined_vars());
        });

        $app->get("/projects/t", function() use($app, $cat) {
            $nav = $cat['projects'];
            $categories = $nav['sub'];
            $sub = $categories['t'];
            $projects = Article::getSpecList(Article::getCat("PROJECT_T"), 1 ,10);
            $app->render("projects/projects_l.html", get_defined_vars());
        });
    }
);
