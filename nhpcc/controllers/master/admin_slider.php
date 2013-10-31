<?php

require_once(APPROOT . "models/Slider.php");

return array(
    "export" => function($app) {
        $app->get("/admin/slider", function() use($app) {
            $sliders = Slider::getList(1);
            $app->render("admin/slider.html", get_defined_vars());
        });

        $app->post("/admin/slider", function() use($app) {
            $title = $app->request->params('title');
            $pic = $app->request->params('pic');
            $url = $app->request->params('url');
            $slider = new Slider($title, $pic, $url);
            $slider->save();
            $slider->flush();
            echo json_encode(array("success" => true, "message" => array("添加成功")));
        });

        $app->get("/admin/slider/create", function() use($app) {
            $app->render("admin/slider-create.html");
        });

        $app->delete("/admin/slider/:id", function($id) use($app) {
            $slider = Slider::find($id);
            $slider->remove();
            $slider->flush();
            echo json_encode(array("success" => true, "message" => array("删除成功")));
        })->conditions(array("id" => "\d+"));
    }
);
