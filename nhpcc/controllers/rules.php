<?php

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/rules", function() use($app, $cat) {
            $nav = $cat['rules'];
            $app->render("rules.html", get_defined_vars());
        });

    }
);
