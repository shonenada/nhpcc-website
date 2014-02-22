<?php

class Slimx extends \Slim\Slim {

    public function register_controller ($php_file) {
        $controllers_installer = $php_file['export'];
        $controllers_installer($this);
    }

}