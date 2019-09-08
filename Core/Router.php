<?php

namespace Core;

final class Router
{
    /**
     * @var array $routes static property containing routes ([url => ['controller' => string, 'action' => string]], ...)
     */
    private static $routes = [];

    /**
     * store path in the static $routes property
     * 
     * @param string $url path to compare
     * @param array $query controller and action associate to $url (['controller' => string, 'action' => string])
     */
    public static function connect(string $url, array $query)
    {
        self::$routes[$url] = $query;
    }

    /**
     * compare url to known paths in $routes property
     * 
     * @param string $url path to compare
     * @return array|null controller and action associate to $url (['controller' => string, 'action' => string]) or null
     */
    public static function get(string $url)
    {
        $dashPos = strpos($url, '/', 1);
        $requestedUrl = substr($url, $dashPos);
        $query = array_key_exists($requestedUrl, self::$routes)
            ? self::$routes[$requestedUrl]
            : null;
        return $query;
    }
}
