<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Resolve app root: supports standard layout (../), cPanel symlink, or explicit path file
$appRoot = file_exists(__DIR__.'/../bootstrap/app.php')
    ? __DIR__.'/..'
    : (file_exists(__DIR__.'/app_path.php') ? trim(require __DIR__.'/app_path.php') : null);

if (! $appRoot || ! file_exists($appRoot.'/bootstrap/app.php')) {
    http_response_code(503);
    exit('Application path not configured. Create public/app_path.php returning the app root path.');
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $appRoot.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $appRoot.'/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once $appRoot.'/bootstrap/app.php';

$app->handleRequest(Request::capture());
