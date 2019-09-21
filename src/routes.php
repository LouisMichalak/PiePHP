<?php

use Core\Router;

/**
 * Path definitions
 * 
 * route with litteral definitions and slugs, have to be positionned before
 * routes with only slugs
 */
Router::connect('/', ['controller' => 'app', 'action' => 'index']);
Router::connect('/register', ['controller' => 'user', 'action' => 'add']);
Router::connect('/registerValidation', ['controller' => 'user', 'action' => 'register']);
Router::connect('/user', ['controller' => 'user', 'action' => 'index']);
Router::connect('/user/{id}', ['controller' => 'user', 'action' => 'show']);
Router::connect('/user/login', ['controller' => 'user', 'action' => 'login']);
Router::connect('/article/relations', ['controller' => 'article', 'action' => 'relations']);