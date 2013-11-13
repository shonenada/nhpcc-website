<?php

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/projects", function() use($app, $cat) {
            $nav = $cat['projects'];
            $categories = $nav['sub'];
            $app->render("projects/index.html", get_defined_vars());
        });

        $app->get("/projects/l", function() use($app, $cat) {
            $nav = $cat['projects'];
            $categories = $nav['sub'];
            $sub = $categories['l'];
            $app->render("projects/projects_l.html", get_defined_vars());
        });

        $app->get("/projects/t", function() use($app, $cat) {
            $nav = $cat['projects'];
            $categories = $nav['sub'];
            $sub = $categories['t'];
            $app->render("projects/projects_l.html", get_defined_vars());
        });
    }
);
