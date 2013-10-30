<?php
require_once(APPROOT . "models/user.php");

return array(
    "export" => function($app) {
        
        $app->get("/", function() use($app) {
            $app->render("index.html");
        });

        $app->get("/admin", function() use($app){
            $app->redirect("/admin/status");
        });

        $app->get("/admin/status", function() use($app) {
            $app->render("admin/status.html");
        });

    }
);
