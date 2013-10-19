<?php
return array(
    "export" => function($app){

        $cat = require(APPROOT. 'config/static/categories.php');
        $atcle = require(APPROOT. 'config/static/contents.php');

        $generateStaticContent = function($ap, $category, $subName) use($cat, $atcle){
            $nav = $cat[$category];
            $categories = $nav['sub'];
            $sub = $categories[$subName];
            $article = $atcle[$category][$subName];
            $ap->render("sub.html", get_defined_vars());
        };

        $app->get("/overview", function() use($app) {
            $app->redirect("/overview/introduction");
        });

        $app->get("/overview/introduction", function() use($app, $generateStaticContent){
            $generateStaticContent($app, 'overview', 'introduction');
        });

        $app->get("/overview/academic", function() use($app, $generateStaticContent){
            $generateStaticContent($app, 'overview', 'academic');
        });

        $app->get("/overview/team", function() use($app, $generateStaticContent){
            $generateStaticContent($app, 'overview', 'team');
        });

    }
);
