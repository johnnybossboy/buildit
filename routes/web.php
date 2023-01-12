<?php

use App\Models\Recipe;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;

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

// Route::get('/', [TodoListController::class, 'index']);

// Route::post('/saveItem', [TodoListController::class, 'saveItem'])->name('saveItem');
// Route::post('/markComplete/{id}', [TodoListController::class, 'markComplete'])->name('markComplete');

Route::get('/', [RecipesController::class, 'index']);
Route::post('/addRecipe', [RecipesController::class, 'addRecipe'])->name('addRecipe');
Route::post('/updateRecipe/{id}', [RecipesController::class, 'updateRecipe'])->name('updateRecipe');
Route::get('/deleteRecipe/{id}', [RecipesController::class, 'deleteRecipe'])->name('deleteRecipe');
