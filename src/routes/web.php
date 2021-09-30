<?php

use Illuminate\Support\Facades\Route;


$laravel = app();
$version = $laravel::VERSION;
if ($version >= 8) {
    Route::get(config('documentation.documentation_url'), [DocumentationController::class, 'web']);
} else {
    Route::get(config('documentation.documentation_url'), 'DocumentationController@web');
}

