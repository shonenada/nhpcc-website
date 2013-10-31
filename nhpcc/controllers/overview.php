<?php

require_once(APPROOT. "models/User.php");

return array(
    "export" => function($app){

        $cat = require(APPROOT. 'static_contents/categories.php');
        $atcle = require(APPROOT. 'static_contents/contents.php');

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

        $app->get("/overview/introduction", function() use($app, $generateStaticContent) {
            $generateStaticContent($app, 'overview', 'introduction');
        });

        // $app->get("/overview/academic", function() use($app, $generateStaticContent){
        //     $generateStaticContent($app, 'overview', 'academic');
        // });

        $app->get("/overview/team", function() use($app, $cat, $atcle) {
            $team = User::getTeamList();
            $nav = $cat['overview'];
            $categories = $nav['sub'];
            $sub = $categories['team'];
            $article = $atcle['overview']['team'];
            $app->render('overview/team.html', get_defined_vars());
        });

        $app->get("/overview/team/:id", function($id) use($app, $cat, $atcle) {
            $teacher = User::find($id);
            $nav = $cat['overview'];
            $categories = $nav['sub'];
            $sub = $categories['team'];
            $article = $atcle['overview']['team'];
            $app->render("overview/team-member.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));

    }
);
