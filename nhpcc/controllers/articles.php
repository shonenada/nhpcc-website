<?php

use \Model\User;
use \Model\Article;

return array(
    "export" => function($app) {
        $app->get("/article/:id", function($id) use($app) {
            $article = Article::find($id);
            $rc = $article->getReadCount();
            $article->setReadCount($rc+1);
            $article->save();
            $article->flush();
            $article->setAuthor(User::find($article->getAuthor()));
            return $app->render("article.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));
    }
);
