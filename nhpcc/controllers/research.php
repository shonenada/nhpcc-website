<?php

use \Utils;

return array(
    "export" => function($app) {

        $cat = Utils::loadStaticContent('categories')->getContent();

        $categories = array(
            "system" => array('title' => '普及型高性能计算机体系结构', 'url' => "/research/system"),
            "theory" => array('title' => '普及型高性能计算机系统软件及理论', 'url' => "/research/theory"),
            "security" => array('title' => '普及型高性能计算安全防护', 'url' => "/research/security"),
            "sustain" => array('title' => '普及型高性能计算机应用基础理论和支撑技术', 'url' => "/research/sustain"),
        );

        $app->get("/research", function() use($app, $cat) {
            return $app->redirect("/research/system");
        });

        $app->get("/research/system", function() use($app, $cat, $categories) {
            $nav = $cat['research'];
            return $app->render("research/system.html", get_defined_vars());
        });
        $app->get("/research/theory", function() use($app, $cat, $categories) {
            $nav = $cat['research'];
            return $app->render("research/theory.html", get_defined_vars());
        });
        $app->get("/research/security", function() use($app, $cat, $categories) {
            $nav = $cat['research'];
            return $app->render("research/security.html", get_defined_vars());
        });
        $app->get("/research/sustain", function() use($app, $cat, $categories) {
            $nav = $cat['research'];
            return $app->render("research/sustain.html", get_defined_vars());
        });
    }
);
