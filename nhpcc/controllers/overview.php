<?php

use \Utils;
use \Model\User;

return array(
    'export' => function($app){

        $app->get('/overview', function() use ($app) {
            return $app->redirect('/overview/introduction');
        });

        $app->get('/overview/introduction', function () use ($app) {
            $static = Utils::loadStaticContent('overview.introduction');
            return $app->render("full_static_template.html", get_defined_vars());
        });

        $app->get('/overview/team', function() use ($app) {
            $static = Utils::loadStaticContent('overview.team');
            $team = User::getTeamList();
            return $app->render("overview/team.html", get_defined_vars());
        });

        $app->get('/overview/team/:id', function($id) use ($app) {
            $teacher = User::find($id);
            return $app->render('overview/team-member.html', get_defined_vars());
        })->conditions(array('id' => '\d+'));

    }
);
