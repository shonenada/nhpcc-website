<?php


use Model\User;

require_once(APPROOT . 'utils.php');

return array(
    'export' => function($app) {

        $app->get('/reg', function() use($app) {
            return $app->render('reg.html');
        });

        $app->get('/login', function() use ($app) {
            return $app->render('login.html');
        });

        $app->post('/logout', function() use ($app) {
            $app->deleteCookie('user_id');
            $app->deleteCookie('token');
            $output = array('success' => true,
                            'message' => array('退出成功'));
            return json_encode($output);
        });

        $app->post('/login', function() use ($app) {

            $salt = $app->config('salt');
            $username = $app->request->params('username');
            $password = $app->request->params('password');

            if (!isset($username) || strlen($username) < 1){
                $output = array('success' => false,
                                'message' => array('用户名不能为空'));
                return json_encode($output);
            }

            if (!isset($password) || strlen($password) < 1){
                $output = array('success' => false,
                                'message' => array('密码不能为空'));
                return json_encode($output);
            }else{
                $password = User::hashPassword($password, $salt);
            }

            $queryUser = User::findOneBy(array('username' => $username,
                                               'password' => $password));

            if ($queryUser == NULL){
                $output = array('success' => false,
                                'message' => array('帐号或密码错误！'));
                return json_encode($output);
            }
            else{
                $uid = $queryUser->getId();
                $ip = $app->request->getIp();
                $now = new DateTime('now');
                $queryUser->setIP($ip);
                $queryUser->setLastLogin($now);
                $queryUser->save();
                $queryUser->flush();
                $token = generateToken($ip, $now, $salt);
                $app->setEncryptedCookie('user_id', $uid);
                $app->setEncryptedCookie('token', $token);
                $output = array('success' => true,
                                'message' => array('登录成功'));
                return json_encode($output);
            }

        });

        $app->get('/profile', function () use ($app) {
            $app->render('user/profile.html');
        });

        $app->put('/profile/edit', function () use ($app) {
            $currentUser = $app->environment['user'];
            $currentUser->setName($app->request->params('name'));
            $currentUser->setUsername($app->request->params('username'));
            $currentUser->setEmail($app->request->params('email'));
            $currentUser->setPhone($app->request->params('phone'));
            $currentUser->setShortIntro($app->request->params('short_intro'));
            $currentUser->setIntro($app->request->params('intro'));
            $currentUser->save();
            $currentUser->flush();
            $output = array('success' => true,
                            'message' => array('修改成功'));
            return json_encode($output);
        });

        $app->get('/profile/password', function () use ($app) {
            return $app->render('user/password.html');            
        });

        $app->put('/profile/password', function () use ($app) {
            $currentUser = $app->environment['user'];

            $new_passwd = $app->request->params('new_passwd');

            $correct = $currentUser->checkPassword($app->request->params('old_passwd'), $app->config('salt'));
            if(!$correct) {
                return json_encode(array(
                        'success' => false,
                        'message' => array('密码错误，请重新输入。')
                    ));
            }

            if (! ($new_passwd == $app->request->params('confirm_passwd'))){
                return json_encode(array(
                        'success' => false,
                        'message' => array('确认密码不匹配，请确认后重新提交')
                    ));
            }

            if (strlen($new_passwd) < 8 ){
                return json_encode(array(
                        'success' => false,
                        'message' => array('密码不能少于 8 个字符')
                    ));
            }

            $currentUser->setPassword($new_passwd, $app->config('salt'));
            $currentUser->save();
            $currentUser->flush();
            return json_encode(array(
                'success' => true,
                'message' => array('密码修改成功'),
                ));
        });
    }
);
