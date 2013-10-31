<?php
require_once(APPROOT . "models/user.php");
require_once(APPROOT . "models/news.php");

return array(
    "export" => function($app) {
        $app->get("/", function() use($app) {
            // 首页
            $news = News::getList(1, 7);
            foreach($news as &$n){
                $author_id = $n->getAuthor();
                $n['a'] = User::find($author_id);
            }
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
