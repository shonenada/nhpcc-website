<?php

require_once(APPROOT . "models/user.php");

return array(
    "export" => function($app) {

        $app->get("/", function() use ($app) {
            $app->render("index.html");
        });

        $app->get("/login", function() use ($app) {
            $app->render("login.html");
        });

        $app->post("/login", function() use ($app) {
          
        });

    }
);
