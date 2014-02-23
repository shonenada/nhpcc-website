<?php

use \Utils;

return array(
    "export" => function($app) {

        $cat = Utils::loadStaticContent('categories')->getContent();

        $app->get("/download", function() use($app, $cat) {
            $nav = $cat['download'];
            return $app->render("download.html", get_defined_vars());
        });

    }
);
