<?php

use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MonhocController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GiohocController;
use App\Http\Controllers\addTeacherController;
use App\Http\Controllers\addGiohocController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\addClassController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//fontend
Route::get('/calendar', [CalendarController::class, 'index']);
Route::get('/', [AdminController::class, 'index']);


//backend
Route::get('/admin',[AdminController::class,'index']);
Route::get('/phonghoc',[RoomsController::class, 'index']);
Route::get('/monhoc',[MonhocController::class, 'index']);
Route::get('/giaovien',[TeacherController::class, 'index']);
Route::get('/giohoc',[GiohocController::class, 'index']);
Route::get('/lophoc',[ClassController::class, 'index']);


// get view pages
Route::get('/addTeacher',[TeacherController::class, 'viewAddTeacher']);
Route::get('/addGiohoc',[GiohocController::class, 'viewAddGiohoc']);
Route::get('/addMonhoc', [MonhocController::class, 'viewAddMonhoc']);
Route::get('/addClass', [ClassController::class, 'viewAddClass']);

Route::get('/addPhonghoc/{id},{time},{day},{idDay}', [
    'as' => 'addPhonghoc',
    'uses' => 'App\Http\Controllers\RoomsController@viewAddPhonghoc'
]);
Route::get('infoRoom/{id}',[
    'as' => 'infoRoom',
    'uses' => 'App\Http\Controllers\RoomsController@infoRoom'
]);







// action post
Route::post('/create_time',[
    'as' => 'create_time',
    'uses' => 'App\Http\Controllers\GiohocController@createTime'
]);
Route::post('/create_teacher',[
    'as' => 'create_teacher',
    'uses' => 'App\Http\Controllers\TeacherController@createTeacher'
]);
Route::get('/room_available/{id}',[
    'as' => 'room_available',
    'uses' => 'App\Http\Controllers\RoomsController@show_available'
]);
Route::post('/create_courses',[
    'as' => 'create_courses',
    'uses' => 'App\Http\Controllers\MonhocController@createCourses'
]);
Route::post('/create_classes',[
    'as' => 'create_classes',
    'uses' => 'App\Http\Controllers\ClassController@createClasses'
]);

Route::post('/create_room/{id},{time},{day}',[
    'as' => 'create_room',
    'uses' => 'App\Http\Controllers\RoomsController@createRoom'
]);


