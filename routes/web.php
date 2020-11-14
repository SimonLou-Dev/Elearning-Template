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

//Auth
Auth::routes();
Route::get('/logout', function (){
   auth()->logout();
   Session()->flush();

   return \Illuminate\Support\Facades\Redirect::to('/');
})->name('logout');

//index page
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'MainController@home')->name('homepage');

//Main page of instructor
Route::get('/instructor/overview', 'InstructorController@index')->name('instructor.index');

// Modification of courses by instructor
Route::get('/instructor/new', 'InstructorController@create')->name('instructor.create');
Route::get('/instructor/courses/{id}/edit', 'InstructorController@edit')->name('instructor.edit');
Route::post('/instructor/courses/store', 'InstructorController@store')->name('instructor.store');
Route::put('/instructor/courses/{id}/update', 'InstructorController@update')->name('instructor.update');
Route::get('/instructor/courses/{id}/destroy', 'InstructorController@destroy')->name('instructor.destroy');
Route::get('/instructor/{id}/courses/publish', 'InstructorController@publish')->name('instructor.publish');

// Courses pricing by instructor
Route::get('/instructor/{id}/courses/pricing', 'PricingController@pricing')->name('instructor.pricing');
Route::post('/instructor/{id}/courses/pricing/post', 'PricingController@store')->name('instructor.pricing.post');

// Courses curriculum by instructor
Route::get('/instructor/courses/{id}/curriculum', 'CurriculumController@index')->name('instructor.curriculum.index');
Route::get('/instructor/courses/{id}/curriculum/add', 'CurriculumController@create')->name('instructor.curriculum.add');
Route::post('/instructor/courses/{id}/curriculum/store', 'CurriculumController@store')->name('instructor.curriculum.store');
Route::get('/instructor/courses/{id}/curriculum/{section}/edit', 'CurriculumController@edit')->name('instructor.curriculum.edit');
Route::put('/instructor/courses/{id}/curriculum/{section}/update', 'CurriculumController@update')->name('instructor.curriculum.update');
Route::get('/instructor/courses/{id}/curriculum/{section}/destroy', 'CurriculumController@destroy')->name('instructor.curriculum.destroy');

// Display courses

Route::get('/courses', 'CoursesController@courses')->name('courses.index');
Route::get('/course/{slug}', 'CoursesController@course')->name('course');