<?php

namespace Core;

abstract class Controller
{
    /**
     * @var string $_render Static property that will contain html code to print
     */
    protected static $_render = '';

    /**
     * render index from associate Controller
     */
    public function indexAction()
    {
        self::render('index');
    }

    /**
     * store the view in $_render
     * 
     * @param string $view name of the view to print
     * @param array $scope structure containing names and values of variable to send to the view (name => value)
     */
    protected function render(string $view, array $scope = [])
    {
        extract($scope);
        $f = implode(
            DIRECTORY_SEPARATOR,
            [
                dirname(__DIR__),
                'src',
                'View',
                str_replace(
                    'Controller',
                    '',
                    basename(get_class($this))
                ),
                $view
            ]
        );
        $f .= '.php';
        if (file_exists($f)) {
            ob_start();
            include($f);
            $view = ob_get_clean();
            ob_start();
            include(
                implode(
                    DIRECTORY_SEPARATOR,
                    [
                        dirname(__DIR__),
                        'src',
                        'View',
                        'index'
                    ]
                ) . '.php'
            );
            self::$_render = ob_get_clean();
        }
    }

    /**
     * print the $_render
     */
    public function __destruct()
    {
        echo self::$_render;
    }
}