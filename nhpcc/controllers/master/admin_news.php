<?php
require_once(APPROOT . "models/user.php");
require_once(APPROOT . "models/news.php");

return array(
    "export" => function($app) {
        $app->get("/admin/news", function() use($app) {
            $page = $app->request->params("page") ? $app->request->params("page") : 1;
            $news = News::getList($page);
            foreach($news as &$n){
                $uid = $n->getAuthor();
                $qu = User::find($uid);
                $n->setAuthor($qu);                
            }
            $app->render("admin/news.html", get_defined_vars());
        });

        $app->post("/admin/news", function() use($app) {
            $title = $app->request->params("title");
            $content = $app->request->params("content");
            $author = $app->environment['user'];
            $message = array();
            $success = false;
            $news = new News($title, $author->getId(), $content);
            $news->save();
            $news->flush();
            $success = true;
            array_push($message, "添加成功");
            $output = array("success" => $success, "message" => $message);
            echo json_encode($output);
            return ;
        });

        $app->get("/admin/news/create", function() use($app) {
            $app->render("admin/news-create.html");
        });

        $app->get("/admin/news/:id", function($id) use($app) {
            $action = 'view';
            $queryNews = News::find($id);
            $queryNews->setAuthor(User::find($queryNews->getAuthor()));
            $app->render("admin/news-view.html", get_defined_vars());
        })->conditions(array('id' => '\d+'));

        $app->put("/admin/news/:id/edit", function($id) use($app) {
            $queryNews = News::find($id);
            $success = false;
            $message = array();
            if ($queryNews == null){
                array_push($message, "信息不存在");
            } else {
                $title = $app->request->params("title");
                $content = $app->request->params("content");
                $queryNews->setTitle($title);
                $queryNews->setContent($content);
                $queryNews->save();
                $queryNews->flush();
                $success = true;
                array_push($message, "修改成功");
            }
            echo json_encode(array("success" => $success, "message" => $message));
        })->conditions(array('id' => '\d+'));

        $app->get("/admin/news/:id/edit", function($id) use($app) {
            $action = 'edit';
            $queryNews = News::find($id);
            $queryNews->setAuthor(User::find($queryNews->getAuthor()));
            $app->render("admin/news-view.html", get_defined_vars());
        })->conditions(array('id' => '\d+'));

        $app->delete("/admin/news/:id", function($id) use($app) {
            $queryNews = News::find($id);
            $queryNews->setDeleted();
            $queryNews->save();
            $queryNews->flush();
            $success = true;
            $message = array("删除成功");
            $output = array("success" => $success,
                            "message" => $message);
            echo json_encode($output);
            return ;
        })->conditions(array('id' => '\d+'));
    }
);
