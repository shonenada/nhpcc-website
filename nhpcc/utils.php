<?php

function generateToken($ip, $now, $salt){
    $now = $now->format('Y-m-d H:i:s');
    return md5($now . "{" . $salt . "}" . $ip);
}

function require_controller ($controller_name) {
    return require_once (APPROOT . "controllers/{$controller_name}.php");
}