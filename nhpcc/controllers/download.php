<?php

use \Utils;
use \Model\User;
use \Model\Article;

return array(
    "export" => function($app) {

        $cat = Utils::loadStaticContent('category')->getContent();

        $app->get("/download", function() use($app, $cat) {
            $nav = $cat['download'];
            $arts = Article::getSpecList(Article::getCat("DOWNLOAD_DOWNLOAD"), 1, 50);
            return $app->render("full-sub-index.html", get_defined_vars());
        });

        $app->get("/download/:id", function($id) use($app, $cat) {
            $nav = $cat['download'];
            $article = Article::find($id);
            $rc = $article->getReadCount();
            $article->setReadCount($rc+1);
            $article->save();
            $article->flush();
            $article->setAuthor(User::find($article->getAuthor()));
            return $app->render("full-sub.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));

    }
);
