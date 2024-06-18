<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
$router = new Router();


// --------------------------LOGIN------------------------------||
$router->get('/',[LoginController::class,'login']);
$router->post('/',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);

// ------------------------CREATE ACCOUNT-----------------------||
$router->get('/create',[LoginController::class,'create']);
$router->post('/create',[LoginController::class,'create']);

//-------------------------FORGOT PASSWORD----------------------||
$router->get('/forgot',[LoginController::class,'forgot']);
$router->post('/forgot',[LoginController::class,'forgot']);

//-------------------------RECOVER PASSWORD---------------------||
$router->get('/recover',[LoginController::class,'recover']);
$router->post('/revover',[LoginController::class,'recover']);

//-----------------------VERIFY ACCOUNT-------------------------||
$router->get('/message',[LoginController::class,'message']);
$router->get('/verify',[LoginController::class,'verify']);







// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
