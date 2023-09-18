<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendmail(){

        Mail::to('hancie@gmail.com')->send(new ContactMail());
        return new ContactMail();
    }
}
