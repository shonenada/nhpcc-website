<?php

use Model\User;
use Model\Article;

return array(
    "export" => function($app) {
        $app->get("/admin/article", function() use($app) {
            $page = $app->request->params("page") ? $app->request->params("page") : 1;
            $article = Article::getList($page, 500);
            foreach($article as &$n){
                $uid = $n->getAuthor();
                $qu = User::find($uid);
                $n->setAuthor($qu);                
            }
            return $app->render("admin/article.html", get_defined_vars());
        });

        $app->post("/admin/article", function() use($app) {
            $title = $app->request->params("title");
            $content = $app->request->params("content");
            $category = $app->request->params("category");
            $author = $app->environment['user'];
            $message = array();
            $success = false;
            $article = new Article($title, $author->getId(), $content);
            $article->setCategory($category);
            $article->save();
            $article->flush();
            $success = true;
            array_push($message, "添加成功");
            $output = array("success" => $success, "message" => $message);
            return json_encode($output);
        });

        $app->get("/admin/article/create", function() use($app) {
            $categories = Article::$categories;
            return $app->render("admin/article-create.html", get_defined_vars());
        });

        $app->get("/admin/article/:id", function($id) use($app) {
            $action = 'view';
            $queryArticle = Article::find($id);
            $queryArticle->setAuthor(User::find($queryArticle->getAuthor()));
            return $app->render("admin/article-view.html", get_defined_vars());
        })->conditions(array('id' => '\d+'));

        $app->put("/admin/article/:id/edit", function($id) use($app) {
            $queryArticle = Article::find($id);
            $success = false;
            $message = array();
            if ($queryArticle == null){
                array_push($message, "信息不存在");
            } else {
                $title = $app->request->params("title");
                $content = $app->request->params("content");
                $category = $app->request->params("category");
                $queryArticle->setTitle($title);
                $queryArticle->setContent($content);
                $queryArticle->setCategory($category);
                $queryArticle->save();
                $queryArticle->flush();
                $success = true;
                array_push($message, "修改成功");
            }
            return json_encode(array("success" => $success, "message" => $message));
        })->conditions(array('id' => '\d+'));

        $app->get("/admin/article/:id/edit", function($id) use($app) {
            $action = 'edit';
            $queryArticle = Article::find($id);
            $queryArticle->setAuthor(User::find($queryArticle->getAuthor()));
            $categories = Article::$categories;
            return $app->render("admin/article-view.html", get_defined_vars());
        })->conditions(array('id' => '\d+'));

        $app->delete("/admin/article/:id", function($id) use($app) {
            $queryArticle = Article::find($id);
            $queryArticle->setDeleted();
            $queryArticle->save();
            $queryArticle->flush();
            $success = true;
            $message = array("删除成功");
            $output = array("success" => $success,
                            "message" => $message);
            return json_encode($output);
        })->conditions(array('id' => '\d+'));
    }
);
