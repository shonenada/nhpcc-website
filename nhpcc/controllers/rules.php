<?php

require_once(APPROOT . "models/Article.php");

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/rules", function() use($app, $cat) {
            $nav = $cat['rules'];
            $arts = Article::getSpecList(Article::getCat("RULES_RULES"), 1 ,10);
            $app->render("rules.html", get_defined_vars());
        });

        $app->get("/rules/:id", function($id) use($app, $cat) {
            $nav = $cat['rules'];
            $categories = $nav['sub'];
            $article = Article::find($id);
            $app->render("sub.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));

    }
);
