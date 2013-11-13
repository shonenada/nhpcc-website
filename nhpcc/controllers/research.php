<?php

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/research", function() use($app, $cat) {
            $nav = $cat['research'];
            $app->render("research/index.html", get_defined_vars());
        });

    }
);
