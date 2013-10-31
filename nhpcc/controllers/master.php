<?php
require_once(APPROOT . "models/user.php");

return array(
    "export" => function($app) {
        
        $app->get("/", function() use($app) {
            // 首页
            $app->render("index.html");
        });

        $app->get("/admin", function() use($app){
            // 后台首页，跳转到运行状态页面
            $app->redirect("/admin/status");
        });

        $app->get("/admin/status$", function() use($app) {
            // 后台，运行状态
            $app->render("admin/status.html");
        });

        $app->get("/admin/account", function() use($app) {
            // 后台，用户管理，用户列表
            $page = $app->request->params("page") ? $app->request->params("page") : 1;
            $users = User::getList($page);
            $app->render("admin/account.html", get_defined_vars());
        });

        $app->post("/admin/account", function() use($app) {
            // 后台，用户管理，添加用户
            $username = $app->request->params("username");
            $name = $app->request->params("name");
            $password = $app->request->params("password");
            $level = $app->request->params("level");
            $message = array();
            $success = false;
            $queryUser = User::findByUsername($username);
            if ($queryUser == null){
                $newUser = new User($username);
                $newUser->setPassword($password, $app->config("salt"));
                $newUser->setName($name);
                $newUser->setLevel($level);
                $newUser->save();
                $newUser->flush();
                $success = true;
                array_push($message, "添加成功");
            }
            else {
                array_push($message, "用户已存在");
            }
            $output = array("success" => $success, "message" => $message);
            echo json_encode($output);
            return ;
        });

        $app->get("/admin/account/create", function() use($app) {
            // 后台，用户管理，新建用户表单
            $app->render("admin/account-create.html");
        });

        $app->get("/admin/account/:id", function($id) use($app) {
            // 后台，用户管理，浏览用户信息
            $action = "view";
            $queryUser = User::find($id);
            $app->render("admin/account-view.html", get_defined_vars());
        })->conditions(array('id' => '\d+'));

        $app->delete("/admin/account/:id", function($id) use($app) {
            // 后台，用户管理，删除用户
            $queryUser = User::find($id);
            if ($queryUser->getLevel() < 15) {
                $queryUser->setLevel(-1);
                $queryUser->save();
                $queryUser->flush();
                $success = true;
                $message = array("删除成功");
            } else {
                $success = false;
                $message = array("无法删除管理员");
            }
            $output = array("success" => $success,
                            "message" => $message);
            echo json_encode($output);
            return ;
        })->conditions(array('id' => '\d+'));

        $app->get("/admin/account/:id/edit", function($id) use($app) {
            // 后台，用户管理，编辑用户页面
            $action = "edit";
            $queryUser = User::find($id);
            $app->render("admin/account-view.html", get_defined_vars());
        })->conditions(array('id' => '\d+'));


        $app->put("/admin/account/:id/edit", function($id) use($app) {
            // 后台，用户管理，修改用户
            $queryUser = User::find($id);
            $success = false;
            $message = array();
            if ($queryUser == null){
                array_push($message, "用户不存在");
            } else {
                $level = $app->request->params("level");
                $queryUser->setLevel($level);
                $queryUser->save();
                $queryUser->flush();
                $success = true;
                array_push($message, "修改成功");
            }
            echo json_encode(array("success" => $success, "message" => $message));
        })->conditions(array('id' => '\d+'));

    }
);
