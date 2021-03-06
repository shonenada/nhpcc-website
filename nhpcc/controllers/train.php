<?php

use \Utils;
use \Model\Article;

return array(
    "export" => function($app) {

        $cat = Utils::loadStaticContent('category')->getContent();
        $train = require(APPROOT. 'static_contents/train.php');

        $app->get("/train", function() use($app, $cat) {
            $app->redirect("/train/graduate");
            $nav = $cat['train'];
            $categories = $nav['sub'];
            $teachers = Article::getSpecList(Article::getCat("TRAIN_TEACHERS"), 1 ,10);
            $graduate = Article::getSpecList(Article::getCat("TRAIN_GRADUATE"), 1 ,10);
            $loongson = Article::getSpecList(Article::getCat("TRAIN_LOONGSON"), 1 ,10);
            $arts = array_unique(array_merge($teachers, $graduate, $loongson));
            return $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/train/teachers", function() use($app, $cat) {
            $nav = $cat['train'];
            $categories = $nav['sub'];
            $sub = $categories['teachers'];
            $arts = Article::getSpecList(Article::getCat("TRAIN_TEACHERS"), 1 ,10);
            return $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/train/graduate", function() use($app, $cat, $train) {
            $nav = $cat['train'];
            $categories = $nav['sub'];
            $sub = $categories['graduate'];
            $graduates = $train['graduates'];
            return $app->render("train/graduate.html", get_defined_vars());
        });

        $app->get("/train/loongson", function() use($app, $cat) {
            $nav = $cat['train'];
            $categories = $nav['sub'];
            $sub = $categories['loongson'];
            $arts = Article::getSpecList(Article::getCat("TRAIN_LOONGSON"), 1 ,10);
            return $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/train/:id", function($id) use($app, $cat) {
            $nav = $cat['train'];
            $categories = $nav['sub'];
            $article = Article::find($id);
            $rc = $article->getReadCount();
            $article->setReadCount($rc+1);
            $article->save();
            $article->flush();
            $article->setAuthor(User::find($article->getAuthor()));
            return $app->render("sub.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));

    }
);
