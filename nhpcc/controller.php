<?php

function init_controllers($app){

    function scan_controller($path, $app){
        foreach (glob($path) as $filename){
            if (is_dir($filename)){
                scan_controller($filename . "/*", $app);
            } else {
                if (substr($filename, -3) == 'php'){
                    $export = require($filename);
                    $func = $export['export'];
                    $func($app);
                }
            }
        }
    }

    $scan_path = APPROOT . DIRECTORY_SEPARATOR . "controllers/*";
    scan_controller($scan_path, $app);

}
