<?php

class Slimx extends \Slim\Slim {

    protected function mapRoute($args)
    {
        $pattern = array_shift($args);
        $callable = array_pop($args);
        $route = new Routex($pattern, $callable, $this->settings['routes.case_sensitive']);
        $this->router->map($route);
        if (count($args) > 0) {
            $route->setMiddleware($args);
        }

        return $route;
    }

    public function register_controller ($php_file) {
        $controllers_installer = $php_file['export'];
        $controllers_installer($this);
    }

}