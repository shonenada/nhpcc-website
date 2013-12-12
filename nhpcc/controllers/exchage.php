<?php
require_once(APPROOT . "models/Article.php");

return array(
    "export" => function($app) {

        $cat = require(APPROOT. 'static_contents/categories.php');

        $app->get("/exchange", function() use($app, $cat) {
            $nav = $cat['exchange'];
            $categories = $nav['sub'];
            $arts = Article::getSpecList(Article::getCat("INDEX_ACTIVATY"), 1, 50);
            $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/exchange/:id", function($id) use($app, $cat) {
            $nav = $cat['exchange'];
            $categories = $nav['sub'];
            $article = Article::find($id);
            $rc = $article->getReadCount();
            $article->setReadCount($rc+1);
            $article->save();
            $article->flush();
            $article->setAuthor(User::find($article->getAuthor()));
            $app->render("sub.html", get_defined_vars());
        })->conditions(array("id" => "\d+"));

    }
);
