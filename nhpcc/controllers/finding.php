<?php

use \Utils;
use \Model\Article;

return array(
    "export" => function($app) {

        $cat = Utils::loadStaticContent('categories')->getContent();

        $app->get("/finding", function() use($app, $cat) {
            $nav = $cat['finding'];
            $arts = Article::getSpecList(Article::getCat("FINDING_FINDING"), 1, 50);
            return $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/finding/:id", function($id) use($app, $cat) {
            $nav = $cat['finding'];
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
