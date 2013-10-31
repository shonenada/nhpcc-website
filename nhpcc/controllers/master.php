<?php
require_once(APPROOT . "models/user.php");

return array(
    "export" => function($app) {
        
        $app->get("/", function() use($app) {
            $app->render("index.html");
        });

        $app->get("/admin", function() use($app){
            $app->redirect("/admin/status");
        });

        $app->get("/admin/status", function() use($app) {
            $app->render("admin/status.html");
        });

        $app->get("/admin/account", function() use($app) {
            $page = $app->request->params("page") ? $app->request->params("page") : 1;
            $users = User::getList($page);
            $app->render("admin/account.html", get_defined_vars());
        });

        $app->get("/admin/account/:id", function($id) use($app) {
            $action = "view";
            $queryUser = User::find($id);
            $app->render("admin/account-view.html", get_defined_vars());
        });

        $app->delete("/admin/account/:id", function($id) use($app) {
            $queryUser = User::find($id);
            $queryUser->setLevel(-1);
            $output = array("success" => true,
                            "messaeg" => array("删除成功"));
        });

        $app->get("/admin/account/:id/edit", function($id) use($app) {
            $action = "edit";
            $queryUser = User::find($id);
            $app->render("admin/account-view.html", get_defined_vars());
        });
    }
);
