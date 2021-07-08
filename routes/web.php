<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ManageController;
use App\Http\Controllers\ProfileController;
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

Route::get('welcome', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/faculties/{university_id}', [HomeController::class, 'faculties'])->name('faculties');
Route::get('/departments/{faculty_id}', [HomeController::class, 'departments'])->name('departments');
Route::get('/department/{department_id}', [HomeController::class, 'department'])->name('department');
Route::post('/universities/search', [HomeController::class, 'university_search']);
Route::post('/university/readmore', [HomeController::class, 'university_readmore']);
Route::post('/faculties/search', [HomeController::class, 'faculty_search']);
Route::post('/faculty/readmore', [HomeController::class, 'faculty_readmore']);
Route::post('/departments/search', [HomeController::class, 'department_search']);
Route::post('/department/readmore', [HomeController::class, 'department_readmore']);

Route::get('/volunteering', [HomeController::class, 'volunteers'])->name('volunteering');
Route::post('/volunteering/search', [HomeController::class, 'volunteers_search']);
Route::get('/professor', [HomeController::class, 'professors'])->name('professor');
Route::post('/professor/search', [HomeController::class, 'professors_search']);

Route::get('/support', [HomeController::class, 'support'])->name('support');
Route::post('/support/save', [HomeController::class, 'support_save'])->name('support.save');
Route::get('/email', function() {
    return view('pages.email');
});

Route::prefix('auth')->group(function() {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/signin', [AuthController::class, 'signin'])->name('auth.signin');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/signup', [AuthController::class, 'signup'])->name('auth.signup');
    Route::get('/forgot_password', [AuthController::class, 'forgot_password'])->name('auth.forgot_password');
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/verify', [AuthController::class, 'verify'])->name('auth.verify');
    Route::post('/authorization', [AuthController::class, 'authorization'])->name('auth.authorization');
});

Route::middleware('auth')->group(function() {
    Route::get('/', function(){
        return redirect('/home');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('/profile')->group(function() {
        Route::get('/personal_info', [ProfileController::class, 'personal_info'])->name('profile.personal_info');
        Route::post('/personal_info/save', [ProfileController::class, 'personal_info_save'])->name('profile.personal_info.save');
        Route::get('/account_info', [ProfileController::class, 'account_info'])->name('profile.account_info');
        Route::post('/account_info/save', [ProfileController::class, 'account_info_save'])->name('profile.account_info.save');
        Route::get('/change_password', [ProfileController::class, 'change_password'])->name('profile.change_password');
        Route::post('/change_password/save', [ProfileController::class, 'change_password_save'])->name('profile.change_password.save');
    });
});

Route::prefix('/')->middleware('auth', 'admin')->group(function() {
    Route::prefix('management')->group(function() {
        Route::get('/menu', [ManageController::class, 'menu'])->name('management.menu');
        Route::get('/users', [ManageController::class, 'users'])->name('management.users');
        Route::post('/users/delete', [ManageController::class, 'user_delete']);
        Route::post('/users/change_state', [ManageController::class, 'state_change']);

        Route::get('/universities', [ManageController::class, 'universities'])->name('management.universities');
        Route::post('/university/save', [ManageController::class, 'university_save'])->name('management.university.save');
        Route::post('/get_university',  [ManageController::class, 'get_university']);
        Route::post('/university/delete', [ManageController::class, 'university_delete']);

        Route::get('/faculties', [ManageController::class, 'faculties'])->name('management.faculties');
        Route::post('/faculty/save', [ManageController::class, 'faculty_save'])->name('management.faculty.save');
        Route::post('/get_faculty',  [ManageController::class, 'get_faculty']);
        Route::post('/faculty/delete', [ManageController::class, 'faculty_delete']);

        Route::get('/departments', [ManageController::class, 'departmens'])->name('management.departments');
        Route::post('/department/add_course', [ManageController::class, 'add_course']);
        Route::post('/department/delete_course', [ManageController::class, 'delete_course']);
        Route::post('/department/save', [ManageController::class, 'department_save'])->name('management.department.save');
        Route::post('/department/get_faculty', [ManageController::class, 'get_faculty_in_department']);
        Route::post('/get_department', [ManageController::class, 'get_department']);
        Route::post('/department/delete', [ManageController::class, 'department_delete']);

        Route::get('/volunteers', [ManageController::class, 'volunteers'])->name('management.volunteers');
        Route::post('/volunteer/save', [ManageController::class, 'volunteer_save'])->name('management.volunteer.save');
        Route::post('/get_volunteer', [ManageController::class, 'get_volunteer']);
        Route::post('/volunteer/delete', [ManageController::class, 'volunteer_delete']);


        Route::get('/professors', [ManageController::class, 'professors'])->name('management.professors');
        Route::post('/professor/save', [ManageController::class, 'professor_save'])->name('management.professor.save');
        Route::post('/get_professor', [ManageController::class, 'get_professor']);
        Route::post('/professor/delete', [ManageController::class, 'professor_delete']);
    });
});

