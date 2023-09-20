<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\NineVarMail;
use App\Mail\CmProgressMail;
use Illuminate\Support\Facades\DB;

class TestingController extends Controller
{
    public function Index()
    {
        $first = 'PO/JSU/23/88888';
        $new_ref_no = str_replace("/","-",$first);
        echo $new_ref_no;
    }

    public function gambar()
    {
        $image = "reject.png";
        $st = 'OK';
        $msg1 = array(
            "St" => $st,
            "image" => $image
        );
        return view("emails.statis", $msg1);
    }
}