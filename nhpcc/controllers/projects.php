<?php
require_once(APPROOT . "models/User.php");
require_once(APPROOT . "models/Article.php");

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');
        $projects = require(APPROOT. 'static_contents/projects.php');

        $app->get("/projects", function() use($app, $cat, $projects) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            $app->render("projects/projects_l.html", get_defined_vars());
        });
    }
);
