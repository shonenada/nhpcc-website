<?php


use Model\User;

require_once(APPROOT . "utils.php");

return array(
    "export" => function($app) {

        $app->get("/reg", function() use($app) {
            $app->render("reg.html");
        });

        $app->get("/login", function() use ($app) {
            $app->render("login.html");
        });

        $app->post("/logout", function() use ($app) {
            $app->deleteCookie("user_id");
            $app->deleteCookie("token");
            $output = array("success" => true,
                            "message" => array("退出成功"));
            echo json_encode($output);
        });

        $app->post("/login", function() use ($app) {

            $salt = $app->config("salt");
            $username = $app->request->params("username");
            $password = $app->request->params("password");

            if (!isset($username) || strlen($username) < 1){
                $output = array("success" => false,
                                "message" => array("用户名不能为空"));
                echo json_encode($output);
                return ;
            }

            if (!isset($password) || strlen($password) < 1){
                $output = array("success" => false,
                                "message" => array("密码不能为空"));
                echo json_encode($output);
                return ;
            }else{
                $password = User::hashPassword($password, $salt);
            }

            $queryUser = User::findOneBy(array("username" => $username,
                                               "password" => $password));

            if ($queryUser == NULL){
                $output = array("success" => false,
                                "message" => array("帐号或密码错误！"));
                echo json_encode($output);
                return ;
            }
            else{
                $uid = $queryUser->getId();
                $ip = $app->request->getIp();
                $now = new DateTime("now");
                $queryUser->setIP($ip);
                $queryUser->setLastLogin($now);
                $queryUser->save();
                $queryUser->flush();
                $token = generateToken($ip, $now, $salt);
                $app->setEncryptedCookie("user_id", $uid);
                $app->setEncryptedCookie("token", $token);
                $output = array("success" => true,
                                "message" => array("登录成功"));
                echo json_encode($output);
                return ;
            }

        });

        $app->get("/profile", function () use ($app) {
            $app->render('user/profile.html');
        });

        $app->put("/profile/edit", function () use ($app) {
            $currentUser = $app->environment["user"];
            $currentUser->setName($app->request->params("name"));
            $currentUser->setUsername($app->request->params("username"));
            $currentUser->setEmail($app->request->params("email"));
            $currentUser->setPhone($app->request->params("phone"));
            $currentUser->setShortIntro($app->request->params("short_intro"));
            $currentUser->setIntro($app->request->params("intro"));
            $currentUser->save();
            $currentUser->flush();
            $output = array("success" => true,
                            "message" => array("修改成功"));
            echo json_encode($output);
            return ;
        });

    }
);
