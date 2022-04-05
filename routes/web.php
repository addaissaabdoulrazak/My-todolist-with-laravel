<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
});

Route::get("/hello", function () {

    return "hello word";
});

//creation d'une route parametrer avec un paramètre obligatoire
route::get("/test/{name}", function ($name) {
    return "bonjour monsieur $name comment allez vous ?";
});

// creation d'une route paramètrer avec un parametre facultatif
// par contre le paramètre de la function anonyme doit obligatoirement avoir une valeur par defaut
route::get("facultatif/{name?}", function ($name = null) {
    return "bonjour monsieur $name";
});

/*********************************************
 *                                           *
 *       Partie : controller                 *
 *                                           *
 ********************************************/

# l'indication du namespace est obligatoire
route::get("/a-propos", "App\Http\Controllers\AproposController@index")->name("apropos");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

route::get('/todos/undone', [App\Http\Controllers\TodoController::class, 'undone'])->name('todos.undone');
route::get('/todos/done', [App\Http\Controllers\TodoController::class, 'done'])->name('todos.done');
route::resource('/todos', App\Http\Controllers\TodoController::class);

//ajout d'une route  permettant  de switché d'une Todo ouverte a une Todo fermé => Done / Undone
route::put('/todos/makedone/{id_current_todo}', 'App\Http\Controllers\TodoController@makedone')->name('todos.makedone');

//assign a todo to a user
route::get('/todos/{id_todos}/affectTo/{id_user}', [\App\Http\Controllers\TodoController::class, 'affectedTo'])->name('assign_A_Todo_To_A_User');
