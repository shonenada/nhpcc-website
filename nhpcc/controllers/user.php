<?php

require_once(APPROOT . "models/user.php");
require_once(APPROOT . "utils.php");

return array(
    "export" => function($app) {

        $app->get("/reg", function() use($app) {
            $app->render("reg.html");
        });

        $app->get("/login", function() use ($app) {
            $app->render("login.html");
        });

        $app->post("/login", function() use ($app) {

            $salt = $app->config("salt");
            $username = $app->request->params("username");
            $password = $app->request->params("password");

            if (!isset($username) || strlen($username) < 1){
                $output = array("success" => false,
                                "message" => "用户名不能为空");
                echo json_encode($output);
                return ;
            }

            if (!isset($password) || strlen($password) < 1){
                $output = array("success" => false,
                                "message" => "密码不能为空");
                echo json_encode($output);
                return ;
            }else{
                $password = User::hashPassword($password, $salt);
            }

            $queryUser = $app->environment['em']->getRepository("User")
                                                ->findOneBy(array(
                                                     "username" => $username,
                                                     "password" => $password));
            if ($queryUser == NULL){
                $output = array("success" => false,
                                "message" => "帐号或密码错误！");
                echo json_encode($output);
                return ;
            }
            else{
                $uid = $queryUser->getId();
                $ip = $app->request->getIp();
                $now = new DateTime("now");
                $queryUser->setIP($ip);
                $queryUser->setLastLogin($now);
                $app->environment['em']->persist($queryUser);
                $app->environment['em']->flush();
                $token = generateToken($ip, $now, $salt);
                $app->setEncryptedCookie("user_id", $uid);
                $app->setEncryptedCookie("token", $token);
                $output = array("success" => true,
                                "message" => "登录成功");
                echo json_encode($output);
                return ;
            }

        });
    }
);
