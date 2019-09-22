<?php

namespace Core;

final class Router
{
    /**
     * @var array $routes static property containing routes ([url => ['controller' => string, 'action' => string]], ...)
     */
    private static $routes = [];

    /**
     * @var array $sluggedRoutes static property containing routes with slugs
     */
    private static $sluggedRoutes = [];

    /**
     * store path in the static $routes property
     * 
     * @param string $url path to compare
     * @param array $query controller and action associate to $url (['controller' => string, 'action' => string])
     */
    public static function connect(string $url, array $query)
    {
        $slugTester = self::regexMatcher($url);
        if($slugTester === false) {
            self::$routes[$url] = $query;
        } else {
            $slugNames = self::regexMatcher($url, true);
            $query['slugs'] = $slugNames;
            self::$sluggedRoutes[$url] = $query;
        }
    }

    /**
     * test if path is an url with slugs
     * 
     * @param string $url path
     * @param bool $all false to return a boolean only, true to return matches (optionnal)
     * @param string $regex specified regex to check (optionnal)
     * @return array|bool array of matchs or bool if $all is set to false
     */
    private static function regexMatcher(string $url, bool $all = false, $regex = '/{(\w*)}/')
    {
        if($all === false) {
            return preg_match($regex, $url) === 0
                ? false
                : true;
        } else {
            $arrayResult = [];
            preg_match_all($regex, $url, $arrayResult);
            return array_slice($arrayResult, 1);
        }
    }

    /**
     * build a regex from an url with slugs to compare with actual url
     * 
     * @param string $url path to convert
     * @return string $regex converted
     */
    private static function regexBuilder(string $url)
    {
        $regex = '/^';
        $fragUrl = preg_split('/({\w*})/', $url, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach($fragUrl as $fragment) {
            if(preg_match('/{\w*}/', $fragment) === 1) {
                $regex .= '(\w*)';
            } else {
                $regex .= str_replace('/', "\/", $fragment);
            }
        }
        $regex .= '$/';
        return $regex;
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
        if($query === null) {
            foreach(self::$sluggedRoutes as $comparePath => $result) {
                $regex = self::regexBuilder($comparePath);
                if(preg_match($regex, $requestedUrl) === 1) {
                    $arrayMatchs = self::regexMatcher(
                        $requestedUrl,
                        true,
                        $regex
                    );
                    $result['slugs'] = array_reverse($result['slugs']);
                    $arrayOfResults = [];
                    foreach($result['slugs'][0] as $key => $value) {
                        $arrayOfResults[$value] = $arrayMatchs[$key][0];
                    }
                    $result['slugs'] = $arrayOfResults;
                    return $result;
                }
            }
        }
        return $query;
    }
}
