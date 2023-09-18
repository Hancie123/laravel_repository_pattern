<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MailController;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[ContactController::class,'index']);

Route::get('/emails',[MailController::class,'sendmail']);

Route::post('/',[ContactController::class,'store']);




Route::get('/delete/{id}',[ContactController::class,'destroy']);
