<?php
spl_autoload_register('autoloader');
function autoloader($class) {
    $class = str_replace('\\', '/', $class);
    $class = strpos($class, 'App') === 0
        ? 'src' . substr($class, 3)
        : $class;
    if(file_exists($class . '.php')) {
        require_once $class . '.php';
    }
}
