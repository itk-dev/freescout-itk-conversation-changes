<?php

Route::group(['middleware' => 'web', 'prefix' => \Helper::getSubdirectory(), 'namespace' => 'Modules\ItkConversationChanges\Http\Controllers'], function()
{
    Route::get('/', 'ItkConversationChangesController@index');
});
