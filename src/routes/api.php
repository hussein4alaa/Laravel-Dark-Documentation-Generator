<?php

use g4t\Documentation\Controllers\DocumentationController;
use Illuminate\Support\Facades\Route;


$laravel = app();
$version = $laravel::VERSION;
if ($version >= 8) {
    Route::get(config('documentation.json_url'), [DocumentationController::class, 'index']);
} else {
    Route::get(config('documentation.json_url'), 'DocumentationController@index');
}

