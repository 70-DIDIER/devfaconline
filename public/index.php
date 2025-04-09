<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Vérification du Mode Maintenance
|--------------------------------------------------------------------------
*/
// Chemin corrigé : ../storage/ au lieu de ../../laravel/storage/
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Chargement de l'Autoloader
|--------------------------------------------------------------------------
*/
// Chemin corrigé : ../vendor/ au lieu de ../../laravel/vendor/
require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Lancement de l'Application
|--------------------------------------------------------------------------
*/
// Chemin corrigé : ../bootstrap/ au lieu de ../../laravel/bootstrap/
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);