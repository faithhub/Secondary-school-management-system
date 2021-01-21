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

// Route::get('/user', function () {
//     return view('users.index');
// });

Auth::routes();

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about']);
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact']);
Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faq']);


// Students
Route::group(['prefix' => 'student', 'middleware' => ['auth', 'student']], function () {
  Route::get('/', [\App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student');

  //Settings
  Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Student\SettingsController::class, 'index'])->name('student_profile');
  Route::post('/change-password', [\App\Http\Controllers\Student\ChangePasswordController::class, 'change']);

  //Subject
  Route::get('subjects', [\App\Http\Controllers\Student\SubjectController::class, 'index']);
  Route::get('download-result', [\App\Http\Controllers\Student\SubjectController::class, 'download_pdf']);
});

// Teachers
Route::group(['prefix' => 'teacher', 'middleware' => ['auth', 'teacher']], function () {
  Route::get('/', [\App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('teacher');

  //Class
  Route::get('class', [\App\Http\Controllers\Teacher\ClassController::class, 'index']);
  Route::get('view-class/{id}', [\App\Http\Controllers\Teacher\ClassController::class, 'view']);
  Route::post('edit-class', [\App\Http\Controllers\Teacher\ClassController::class, 'edit'])->name('edit-result');
  Route::get('export-data/{id}', [\App\Http\Controllers\Teacher\ClassController::class, 'exportdata']);
  Route::get('export-data-pdf/{id}', [\App\Http\Controllers\Teacher\ClassController::class, 'exportdatapdf']);
  Route::get('download-result-pdf/{id}', [\App\Http\Controllers\Teacher\ClassController::class, 'download_pdf']);
  Route::post('import-data/', [\App\Http\Controllers\Teacher\ClassController::class, 'importresult'])->name('student-upload-result');

  //Student
  Route::get('students', [\App\Http\Controllers\Teacher\StudentController::class, 'index']);

  //Settings
  Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Teacher\SettingsController::class, 'index'])->name('teacher_profile');
  Route::post('/change-password', [\App\Http\Controllers\Teacher\ChangePasswordController::class, 'change']);
});

//Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
  Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin');

  //Settings
  Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin_profile');
  Route::post('/change-password', [\App\Http\Controllers\Admin\ChangePasswordController::class, 'change']);

  //Teacher
  Route::match(['get', 'post'], '/teachers', [App\Http\Controllers\Admin\TeacherController::class, 'create'])->name('admin_create_teacher');
  Route::get('/edit-teacher/{id}', [App\Http\Controllers\Admin\TeacherController::class, 'edit']);
  Route::get('/delete-teacher/{id}', [App\Http\Controllers\Admin\TeacherController::class, 'delete']);
  Route::get('/block-teacher/{id}', [App\Http\Controllers\Admin\TeacherController::class, 'block']);
  Route::get('/unblock-teacher/{id}', [App\Http\Controllers\Admin\TeacherController::class, 'unblock']);

  //Student
  Route::get('students', [App\Http\Controllers\Admin\StudentController::class, 'index']);
  Route::match(['get', 'post'], 'create-student', [App\Http\Controllers\Admin\StudentController::class, 'create'])->name('admin_create_student');
  Route::post('create_bulk_student', [App\Http\Controllers\Admin\StudentController::class, 'create_bulk'])->name('admin_create_bulk_student');
  Route::get('/edit-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'edit']);
  Route::get('/delete-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'delete']);
  Route::get('/block-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'block']);
  Route::get('/unblock-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'unblock']);

  //Subject
  Route::match(['get', 'post'], '/subjects', [App\Http\Controllers\Admin\SubjectController::class, 'create'])->name('admin_create_subject');
  Route::get('edit-subject/{id}', [App\Http\Controllers\Admin\SubjectController::class, 'edit']);
  Route::get('delete-subject/{id}', [App\Http\Controllers\Admin\SubjectController::class, 'delete']);

  //Classes
  Route::match(['get', 'post'], 'classes', [App\Http\Controllers\Admin\ClassesController::class, 'create'])->name('admin_create_class');
  Route::get('edit-class/{id}', [App\Http\Controllers\Admin\ClassesController::class, 'edit']);
  Route::get('view-class/{id}', [App\Http\Controllers\Admin\ClassesController::class, 'view']);
  Route::get('delete-class/{id}', [App\Http\Controllers\Admin\ClassesController::class, 'delete']);
});
