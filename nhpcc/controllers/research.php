<?php

require_once(APPROOT . "models/Article.php");

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $categories = array(
            "system" => array('title' => '普及型高性能计算机体系结构', 'url' => "/research/system"),
            "theory" => array('title' => '普及型高性能计算机系统软件及理论', 'url' => "/research/theory"),
            "security" => array('title' => '普及型高性能计算安全防护', 'url' => "/research/security"),
            "sustain" => array('title' => '普及型高性能计算机应用基础理论和支撑技术', 'url' => "/research/sustain"),
        );

        $app->get("/research", function() use($app, $cat) {
            $app->redirect("/research/system");
        });

        $app->get("/research/system", function() use($app, $cat, $categories) {
            $nav = $cat['research'];
            $app->render("research/system.html", get_defined_vars());
        });
        $app->get("/research/theory", function() use($app, $cat, $categories) {
            $nav = $cat['research'];
            $app->render("research/theory.html", get_defined_vars());
        });
        $app->get("/research/security", function() use($app, $cat, $categories) {
            $nav = $cat['research'];
            $app->render("research/security.html", get_defined_vars());
        });
        $app->get("/research/sustain", function() use($app, $cat, $categories) {
            $nav = $cat['research'];
            $app->render("research/sustain.html", get_defined_vars());
        });
    }
);
