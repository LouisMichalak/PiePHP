<?php

use Core\Router;

/**
 * Path definitions
 */
Router::connect('/', ['controller' => 'app', 'action' => 'index']);
Router::connect('/register', ['controller' => 'user', 'action' => 'add']);
Router::connect('/registerValidation', ['controller' => 'user', 'action' => 'register']);
Router::connect('/user', ['controller' => 'user', 'action' => 'index']);
Router::connect('/user/show', ['controller' => 'user', 'action' => 'show']);
Router::connect('/user/login', ['controller' => 'user', 'action' => 'login']);
