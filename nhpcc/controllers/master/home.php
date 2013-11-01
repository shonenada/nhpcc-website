<?php
require_once(APPROOT . "models/User.php");
require_once(APPROOT . "models/Article.php");
require_once(APPROOT . "models/Slider.php");

return array(
    "export" => function($app) {
        $app->get("/", function() use($app) {
            // 首页
            $news = Article::getSpecList(Article::NEWS, 1, 7);
            $notice = Article::getSpecList(Article::ANNOUNCE, 1, 10);
            $activity = Article::getSpecList(Article::ACTIVATE, 1, 10);
            $static_content = require(APPROOT. 'static_contents/contents.php');
            $links = require(APPROOT. 'static_contents/links.php');
            $academician_intro = $static_content['index_intro'];
            $main_links = $links['main'];
            $sub_links = $links['sub'];
            $sliders = Slider::getList(1, 3);
            $app->render("index.html", get_defined_vars());
        });

        $app->get("/admin", function() use($app){
            // 后台首页，跳转到运行状态页面
            $app->redirect("/admin/status");
        });

        $app->get("/admin/status", function() use($app) {
            // 后台，运行状态
            $app->render("admin/status.html");
        });

    }
);
