<?php

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/finding", function() use($app, $cat) {
            $nav = $cat['finding'];
            $arts = Article::getSpecList(Article::getCat("FINDING_FINDING"), 1 ,10);
            $app->render("finding.html", get_defined_vars());
        });

    }
);
