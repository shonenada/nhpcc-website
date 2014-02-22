<?php

use Model\User;

return array(
    "export" => function($app){

        $cat = require(APPROOT. 'static_contents/categories.php');
        $atcle = require(APPROOT. 'static_contents/contents.php');

        $generateStaticContent = function($app, $category, $subName) use($cat, $atcle){
            $nav = $cat[$category];
            $categories = $nav['sub'];
            $sub = $categories[$subName];
            $article = $atcle[$category][$subName];
            return $app->render("sub.html", get_defined_vars());
        };

        $app->get("/overview", function() use($app) {
            return $app->redirect("/overview/introduction");
        });

        $app->get("/overview/introduction", function() use($app, $generateStaticContent) {
            $generateStaticContent($app, 'overview', 'introduction');
        });

        $app->get("/overview/team", function() use($app, $cat, $atcle) {
            $team = User::getTeamList();
            $nav = $cat['team'];
            $categories = $nav['sub'];
            $article = $atcle['overview']['team'];
            return $app->render('overview/team.html', get_defined_vars());
        });

        $app->get("/overview/team/:id", function($id) use($app, $cat, $atcle) {
            $teacher = User::find($id);
            $nav = $cat['team'];
            $categories = $nav['sub'];
            $article = $atcle['overview']['team'];
            return $app->render("overview/team-member.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));

    }
);
