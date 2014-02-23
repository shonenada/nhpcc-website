<?php

use \Model\StaticContent;

class Utils {

    static public function generateToken($ip, $now, $salt){
        $now = $now->format('Y-m-d H:i:s');
        return md5 ("{$now}{{$salt}}{$ip}");
    }

    static public function require_controller ($controller_name) {
        return require_once (APPROOT . "controllers/{$controller_name}.php");
    }

    static public function loadStaticContent ($module, $asArray=false) {
        $return = StaticContent::loadFromFile(APPROOT . 'static_contents/' . str_replace('.', '/', $module) . '.json', $asArray);
        return $return;
    }

}
