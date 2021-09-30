<?php

use Illuminate\Support\Facades\Route;

    Route::get(config('documentation.json_url'), 'DocumentationController@index');
