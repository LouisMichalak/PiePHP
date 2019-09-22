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
Router::connect('/login', ['controller' => 'user', 'action' => 'login']);
Router::connect('/logout', ['controller' => 'user', 'action' => 'logout']);
Router::connect('/user', ['controller' => 'user', 'action' => 'index']);
Router::connect('/user/updateInfos', ['controller' => 'user', 'action' => 'updateInfos']);
Router::connect('/user/updatePassword', ['controller' => 'user', 'action' => 'updatePassword']);
Router::connect('/user/{id}', ['controller' => 'user', 'action' => 'show']);
Router::connect('/film/add', ['controller' => 'film', 'action' => 'add']);
Router::connect('/film/addValidation', ['controller' => 'film', 'action' => 'addValidation']);
Router::connect('/film/{id}', ['controller' => 'film', 'action' => 'show']);