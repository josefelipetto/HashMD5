<?php
/**
 * Created by PhpStorm.
 * User: josefelipetto
 * Date: 13/09/17
 * Time: 13:18
 */

require 'vendor/autoload.php';

$router = new \Bramus\Router\Router();

$router->post('login','App\Controllers\LoginController@login');

$router->run();