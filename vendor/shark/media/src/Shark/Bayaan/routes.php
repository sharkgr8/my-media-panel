<?php

Route::group(array('prefix' => Config::get('bayaan::prefix', 'admin')), function()
{
    /*
    |--------------------------------------------------------------------------
    | Cpanel Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('/', array(
        'as'     => 'cpanel.home',
        'uses'   => 'Stevemo\Cpanel\Controllers\CpanelController@index',
        'before' => 'auth.cpanel:cpanel.view'
    ));


    /*
    |--------------------------------------------------------------------------
    | Shark Media Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('media', array(
        'as'     => 'bayaan.media.index',
        'uses'   => 'Shark\Bayaan\Controllers\MediaController@index',
        'before' => 'auth.cpanel'
    ));
    Route::post('media', array(
        'as'     => 'bayaan.media.store',
        'uses'   => 'Shark\Bayaan\Controllers\MediaController@store',
        'before' => 'auth.cpanel'
    ));
    Route::get('media/create', array(
        'as'     => 'bayaan.media.create',
        'uses'   => 'Shark\Bayaan\Controllers\MediaController@create',
        'before' => 'auth.cpanel'
    ));
    Route::get('media/{id}', array(
        'as'     => 'bayaan.media.show',
        'uses'   => 'Shark\Bayaan\Controllers\MediaController@show',
        'before' => 'auth.cpanel'
    ));
    Route::get('media/{id}/edit', array(
        'as'     => 'bayaan.media.edit',
        'uses'   => 'Shark\Bayaan\Controllers\MediaController@edit',
        'before' => 'auth.cpanel'
    ));
    Route::put('media/{id}', array(
        'as'     => 'bayaan.media.update',
        'uses'   => 'Shark\Bayaan\Controllers\MediaController@update',
        'before' => 'auth.cpanel'
    ));
    Route::delete('media/{id}', array(
        'as'     => 'bayaan.media.destroy',
        'uses'   => 'Shark\Bayaan\Controllers\MediaController@destroy',
        'before' => 'auth.cpanel'
    ));
    Route::put('media/{media}/activate', array(
        'as'     => 'bayaan.media.activate',
        'uses'   => 'Shark\Bayaan\Controllers\MediaController@putActivate',
        'before' => 'auth.cpanel:media.update'
    ));

    Route::put('media/{media}/deactivate', array(
        'as'     => 'bayaan.media.deactivate',
        'uses'   => 'Shark\Bayaan\Controllers\MediaController@putDeactivate',
        'before' => 'auth.cpanel:media.update'
    ));


});