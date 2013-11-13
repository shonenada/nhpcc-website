<?php

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/download", function() use($app, $cat) {
            $nav = $cat['download'];
            $app->render("download.html", get_defined_vars());
        });

    }
);
