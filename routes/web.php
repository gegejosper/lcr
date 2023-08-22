<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/unknown_user', 'FrontController@unknown_user');
Route::get('/apply', 'FrontController@apply');
Route::get('/thankyou/{client_id}', 'FrontController@thank_you');
Route::post('/client/register', 'FrontController@register');
Route::namespace('Panel')->prefix('panel')->name('panel.')->group(function() {
    Route::middleware('can:manage-admin')->prefix('admin')->name('admin.')->group(function() {
        Route::get('/', 'AdminController@dashboard')->name('dashboard');

        Route::get('/settings', 'AdminController@settings')->name('settings');     
        Route::get('/reports', 'AdminController@reports')->name('reports');     
        Route::get('/settings/roles', 'AdminController@roles')->name('roles');  
        Route::get('/settings/backup', 'AdminController@backup')->name('backup');        
        Route::get('/settings/backup/users', 'BackupController@backup_users')->name('backup_users');        
        Route::get('/settings/users', 'AdminController@users')->name('subscribers');
        Route::get('/settings/users/{user_id}', 'UserController@edit_user')->name('edit_user');  
        Route::post('/settings/users/update', 'UserController@update_user')->name('update_user');  
        Route::post('/settings/users/modify', 'UserController@modify_user')->name('modify_user');  
        Route::post('/settings/users/add', 'UserController@add_user')->name('add_user');  
        
        Route::get('/settings/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    });
    Route::prefix('destinations')->middleware('can:manage-admin')->name('destinations.')->group(function() {
        Route::get('/', 'DestinationController@show_destinations')->name('show_destinations');
        Route::get('/{destination_id}', 'DestinationController@view_destination')->name('view_destination');
        Route::post('/add', 'DestinationController@add_destination')->name('add_destination');
        Route::post('/edit', 'DestinationController@edit_destination')->name('edit_destination');
        Route::post('/modify', 'DestinationController@modify_destination')->name('modify_destination'); 
    });

    Route::prefix('counters')->middleware('can:manage-admin')->name('counters.')->group(function() {
        Route::get('/', 'CounterController@show_counters')->name('show_counters');
        Route::get('/{counter_id}', 'CounterController@view_counter')->name('view_counter');
        Route::post('/add', 'CounterController@add_counter')->name('add_counter');
        Route::post('/edit', 'CounterController@edit_counter')->name('edit_counter');
        Route::post('/modify', 'CounterController@modify_counter')->name('modify_counter'); 
    });
    Route::prefix('clients')->middleware('can:manage-admin')->name('clients.')->group(function() {
        Route::get('/', 'ClientController@show_clients')->name('show_clients');
        Route::get('/{client_id}', 'ClientController@view_client')->name('view_client');
        Route::post('/add', 'ClientController@add_client')->name('add_client');
        Route::post('/edit', 'ClientController@edit_client')->name('edit_client');
        Route::post('/search', 'ClientController@search_clients')->name('search_clients');
        Route::post('/modify', 'ClientController@modify_client')->name('modify_client'); 
    });  
});


require __DIR__.'/auth.php';