<?php

use \Utils;

return array(
    "export" => function($app) {

        $cat = Utils::loadStaticContent('categories')->getContent();
        $projects = require(APPROOT. 'static_contents/projects.php');

        $app->get("/projects", function() use($app, $cat, $projects) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            return $app->render("projects/projects_l.html", get_defined_vars());
        });
    }
);
