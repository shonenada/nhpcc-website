<?php

use Model\User;
use Model\Article;
use Model\Slider;

return array(
    "export" => function($app) {
        $app->get("/", function() use($app) {
            // 首页
            $news = Article::getSpecList(Article::getCat("INDEX_NEWS"), 1, 7);
            $notice = Article::getSpecList(Article::getCat("INDEX_ANNOUNCE"), 1, 11);
            $activity = Article::getSpecList(Article::getCat("INDEX_ACTIVATY"), 1, 11);
            $static_content = require(APPROOT. 'static_contents/contents.php');
            $links = require(APPROOT. 'static_contents/links.php');
            $academician_intro = $static_content['index_intro'];
            $main_links = $links['main'];
            $sub_links = $links['sub'];
            $sliders = Slider::getList(1, 3);
            return $app->render("index.html", get_defined_vars());
        });

        $app->get("/news", function() use($app) {
            $nav = array('url' => '/news', 'title' => '信息简报');
            $arts = Article::getSpecList(Article::getCat("INDEX_NEWS"), 1, 50);
            return $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/annoucnt", function() use($app) {
            $nav = array('url' => '/annoucnt', 'title' => '通知公告');
            $arts = Article::getSpecList(Article::getCat("INDEX_ANNOUNCE"), 1, 50);
            return $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/news/:id", function($id) use($app) {
            $article = Article::find($id);
            $rc = $article->getReadCount();
            $article->setReadCount($rc+1);
            $article->save();
            $article->flush();
            $article->setAuthor(User::find($article->getAuthor()));
            return $app->render("article.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));
        
        $app->get("/annoucnt/:id", function($id) use($app) {
            $article = Article::find($id);
            $rc = $article->getReadCount();
            $article->setReadCount($rc+1);
            $article->save();
            $article->flush();
            $article->setAuthor(User::find($article->getAuthor()));
            return $app->render("article.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));

        $app->get("/admin", function() use($app){
            // 后台首页，跳转到运行状态页面
            return $app->redirect("/admin/status");
        });

        $app->get("/admin/status", function() use($app) {
            // 后台，运行状态
            return $app->render("admin/status.html");
        });

    }
);
