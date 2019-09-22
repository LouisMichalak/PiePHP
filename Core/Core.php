<?php

namespace Core;

final class Core
{
    /**
     * initiate router, check for errors on path and call controller method
     */
    public function run()
    {
        require_once 'src/routes.php';
        $query = Router::get($_SERVER['REQUEST_URI']);
        if($query !== null) {
            $controlledPath = 'App\\Controller\\'
                . ucfirst($query['controller'])
                . 'Controller';
            $controlledMethod = $query['action'] . 'Action';
        }
        if (
            $query === null
            || !class_exists($controlledPath)
            || !method_exists($controlledPath, $controlledMethod)
        ) {
            die('404 path undefined');
        }
        $controllerObj = new $controlledPath();
        session_start();
        call_user_func_array(
            [
                $controllerObj,
                $controlledMethod
            ],
            empty($query['slugs']) ? [] : $query['slugs']
        );
    }
}
