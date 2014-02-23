<?php

use \Utils;

return array(
    "export" => function($app) {
        $app->get('/admin/static', function () use ($app) {
            $content = Utils::loadStaticContent('overview.introduction');
            return $app->render('admin/static.html');
        });

        $app->get('/admin/static/:path', function ($path) use ($app) {
            $static = Utils::loadStaticContent(str_replace('/', '.', $path));
            return $app->render("admin/static_view.html", get_defined_vars());
        })->conditions(array('path' => '(\S+?\/{0,1})+'));

        $app->put('/admin/static/:path/edit', function ($path) use ($app) {
            $static = Utils::loadStaticContent(str_replace('/', '.', $path));
            $static->parse($app->request->params());
            $static->save();
            return json_encode(array('success' => true,));
        })->conditions(array('path' => '(\S+?\/{0,1})+'));

    }
);
