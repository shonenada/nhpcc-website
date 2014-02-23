<?php

use \Utils;
use \Model\User;
use \Model\Article;

return array(
    "export" => function($app) {

        $cat = Utils::loadStaticContent('categories')->getContent();

        $app->get("/foundation", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $manage = Article::getSpecList(Article::getCat("FOUNDATION_MANAGE"), 1, 10);
            $guide = Article::getSpecList(Article::getCat("FOUNDATION_GUIDE"), 1, 10);
            $funding = Article::getSpecList(Article::getCat("FOUNDATION_FUNDING"), 1, 10);
            $arts = array_merge($manage, $guide, $funding);
            return $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/foundation/manage", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $sub = $categories['manage'];
            $arts = Article::getSpecList(Article::getCat("FOUNDATION_MANAGE"), 1, 50);
            return $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/foundation/guide", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $sub = $categories['guide'];
            $arts = Article::getSpecList(Article::getCat("FOUNDATION_GUIDE"), 1, 50);
            return $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/foundation/list", function() use($app, $cat) {
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $sub = $categories['list'];
            $arts = Article::getSpecList(Article::getCat("FOUNDATION_LIST"), 1, 50);
            return $app->render("sub-index.html", get_defined_vars());
        });

        $app->get("/foundation/funding", function() use($app, $cat) {
            $foundation = require(APPROOT. 'static_contents/foundation.php');
            $nav = $cat['foundation'];
            $categories = $nav['sub'];
            $sub = $categories['funding'];
            $arts = Article::getSpecList(Article::getCat("FOUNDATION_FUNDING"), 1, 50);
            return $app->render("/foundation/fundings.html", get_defined_vars());
        });

        $app->get("/foundation/:id", function($id) use($app, $cat) {
            $nav = $cat['foundation'];
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
