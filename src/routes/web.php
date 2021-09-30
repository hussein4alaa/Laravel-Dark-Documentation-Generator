<?php

use Illuminate\Support\Facades\Route;

    Route::get(config('documentation.documentation_url'), 'DocumentationController@web');
