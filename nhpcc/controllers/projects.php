<?php

use \Utils;

return array(
    "export" => function($app) {

        $cat = Utils::loadStaticContent('category')->getContent();
        $projects = Utils::loadStaticContent('projects')->getContent();

        $app->get("/projects", function() use($app, $cat, $projects) {
            $nav = $cat['achievements'];
            $categories = $nav['sub'];
            return $app->render("project.html", get_defined_vars());
        });
    }
);
