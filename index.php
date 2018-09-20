<?php
/**
 * Created by PhpStorm.
 * User: josefelipetto
 * Date: 13/09/17
 * Time: 13:41
 */

define('__DATA_FOLDER', 'src/resources');

// Simula .htacces para o servidor embutido
$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename))
{
    return false;
}

require 'vendor/autoload.php';

$router = new \Bramus\Router\Router();

$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo 'Ish, rota errada. Verifique certinho aí :) ';
});


// Autenticar
$router->get('/','\App\Controllers\LoginController@index');
$router->get('/login','\App\Controllers\LoginController@index');

$router->post('/login','\App\Controllers\LoginController@login');


// Cadastrar
$router->get('/user', '\App\Controllers\UserController@index');
$router->post('/user', '\App\Controllers\UserController@newUser');

// Página principal e quebra de md5
$router->get('/main','\App\Controllers\MainController@index');
$router->post('/md5','\App\Controllers\MainController@breakMD5');


$router->run();

