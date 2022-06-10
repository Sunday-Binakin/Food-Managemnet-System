<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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

Route::get('/', [HomeController::class,'index']);

Route::get('/home', [HomeController::class,'redirect'])->middleware('auth','verified');

Route::get('/login', function () {
    return view('auth\login');
})->name('login');

Route::get('/register', function () {
    return view('auth\register');
})->name('register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
            return view('dashboard');
        }
        )->name('dashboard');    });

Route::get('/add_doctor_view', [AdminController::class,'addview']);
Route::post('/upload_doctor',[AdminController::class,'upload']);

Route::post('/appointment', [HomeController::class , 'appointment'])->name('appointment');
Route::get('/myappointment', [HomeController::class , 'myappointment'])->name('myappointment');
Route::get('/cancel_appoint/{id}', [HomeController::class , 'cancel_appoint'])->name('cancel_appoint'); //cancel appointment
Route::get('/show_appointment', [AdminController::class , 'showAppointment'])->name('show_appointment'); //show appointment url
Route::get('/approved/{id}', [AdminController::class , 'approved'])->name('approved'); //approve appointment url
Route::get('/cancelled/{id}', [AdminController::class , 'cancel'])->name('cancelled'); //cancel appointment

Route::get('/show_doctors', [AdminController::class , 'showDoctors'])->name('show doctors'); //show all doctors

Route::get('/delete_doctor/{id}', [AdminController::class ,'deleteDoctor'])->name('delete_doctor');
Route::get('/update_doctor/{id}', [AdminController::class , 'updateDoctor'])->name('update_doctor');
Route::post('/edit_doctor/{id}', [AdminController::class , 'editDoctor'])->name('edit_doctor');

Route::get('/email_view/{id}', [AdminController::class , 'emailView'])->name('email_view');
Route::post('/send_email/{id}', [AdminController::class , 'sendEmail'])->name('send_email');

//things to fix
//table numbering
//sucess messages 
  