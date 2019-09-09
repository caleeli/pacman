<?php

Route::middleware('auth:api')->namespace('JDD\Pacman\Http\Controllers')->group(function () {
    Route::get('/api/pacman/package', 'PackageController@index');
});
