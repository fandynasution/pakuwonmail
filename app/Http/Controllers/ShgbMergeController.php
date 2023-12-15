<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use App\Mail\UserEmail;
use Illuminate\Support\Facades\DB;

class ShgbMergeController extends Controller
{
    public function mail(Request $request) 
    {
        var_dump($request->all());
    }
}
