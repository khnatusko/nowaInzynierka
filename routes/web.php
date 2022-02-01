<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

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

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Auth::routes();
Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index']);
Route::get('/messages', [App\Http\Controllers\ChatController::class, 'fetchMessages']);
Route::post('/messages', [App\Http\Controllers\ChatController::class, 'sendMessage']);

Route::get('/card', [App\Http\Controllers\CardController::class, 'index']);
Route::get('/getCards', [App\Http\Controllers\CardController::class, 'getCards']);
Route::post('/createcard', [App\Http\Controllers\CardController::class, 'createcard']);

Route::get('/parameters', [App\Http\Controllers\ParametersController::class, 'index']);
Route::post('/createparameters', [App\Http\Controllers\ParametersController::class, 'createparameters']);

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index']);

Route::get('/userlist', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/getUsers', [App\Http\Controllers\UserController::class, 'getUsers']);
Route::get('/search_user', [App\Http\Controllers\UserController::class, 'searchuser']);
Route::get('/allUsers', [App\Http\Controllers\UserController::class, 'allUsers']);
Route::get('/listuser', [App\Http\Controllers\UserController::class, 'listuser']);
Route::get('/getCardsUser',[App\Http\Controllers\UserController::class, 'getCardsUser']);

Route::get('/game', [App\Http\Controllers\SessionController::class, 'index']);
Route::get('/getSession', [App\Http\Controllers\SessionController::class, 'getSession']);
Route::post('/creategame', [App\Http\Controllers\SessionController::class, 'creategame']);


Route::get('/sessiongame', [App\Http\Controllers\SessionController::class, 'start']);
Route::post('/upload', [App\Http\Controllers\MapsController::class, 'upload']);
Route::post('/uploadMusic', [App\Http\Controllers\SoundsController::class, 'uploadMusic']);


Route::get('/getSound', [App\Http\Controllers\SoundsController::class, 'getSound']);

Route::get('/usercard', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home']);

Route::post('/createnote', [App\Http\Controllers\NotesController::class, 'createnote']);
Route::get('/getNote', [App\Http\Controllers\NotesController::class, 'getNote']);
