<?php

require_once(APPROOT . "models/Article.php");

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/research", function() use($app, $cat) {
            $nav = $cat['research'];
            $app->render("research/list.html", get_defined_vars());
        });
    }
);
