<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSendApproval;
use App\Mail\UserEmail;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function sendApprovalMail(Request $request) {
        $callback = array(
            'data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status' => 200
        );

        $dataArray = array(
            'user_id'        => $request->user_id,
            'level_no'       => $request->level_no,
            'entity_cd'      => $request->entity_cd,
            'doc_no'         => $request->doc_no,
            'email_addr'     => $request->email_addr,
        );

        $sendToEmail = strtolower($request->email_addr);
        if(isset($sendToEmail) && !empty($sendToEmail) && filter_var($sendToEmail, FILTER_VALIDATE_EMAIL))
        {
            Mail::to($sendToEmail)->send(new EmailSendApproval($dataArray));
            $callback['Error'] = true;
            $callback['Pesan'] = 'sendToEmail';
            echo json_encode($callback);
        }
    }

    public function changestatus($status='', $entity_cd='', $doc_no='', $level_no='')
    {
        $where2 = array(
            'doc_no'        => $doc_no,
            'status'        => $status,
            'entity_cd'     => $entity_cd,
            'level_no'      => $level_no,
        );
        $query = DB::connection('SSI')
        ->table('mgr.cb_cash_request_appr')
        ->where($where2)
        ->get();
        if(count($query)>0){
            $msg = 'Anda sudah pernah melakukan Approval pada Prospect no. '.$doc_no ;
            $st  = 'OK';
            $image = "restricted.png";
            $msg1 = array(
                "Pesan" => $msg,
                "St" => $st,
                "image" => $image
            );
        } else {
            if($status == 'A') {
                $sqlsendemail = "mgr.xrl_send_mail_approval_prospect_lot '" . $entity_cd . "', '" . $doc_no . "', '" . $status . "', '" . $level_no . "'";
                $snd = DB::connection('SSI')->insert($sqlsendemail);
                if ($snd == '1') {
                    $msg = "Anda berhasil melakukan Approve pada prospect no ".$doc_no;
                    $st = 'OK';
                    $image = "approved.png";
                } else {
                    $msg = "Anda gagal melakukan Approve pada prospect no ".$doc_no;
                    $st = 'OK';
                    $image = "reject.png";
                }
            } else if($status == 'R'){
                $sqlsendemail = "mgr.xrl_send_mail_approval_prospect_lot '" . $entity_cd . "', '" . $doc_no . "', '" . $status . "', '" . $level_no . "'";
                $snd = DB::connection('SSI')->insert($sqlsendemail);
                if ($snd == '1') {
                    $msg = "Anda berhasil melakukan Permintaan Revise pada prospect no ".$doc_no;
                    $st = 'OK';
                    $image = "approved.png";
                } else {
                    $msg = "Anda gagal melakukan Permintaan Revise pada prospect no ".$doc_no;
                    $st = 'OK';
                    $image = "reject.png";
                }
            } else {
                $sqlsendemail = "mgr.xrl_send_mail_approval_prospect_lot '" . $entity_cd . "', '" . $doc_no . "', '" . $status . "', '" . $level_no . "'";
                $snd = DB::connection('SSI')->insert($sqlsendemail);
                if ($snd == '1') {
                    $msg = "Anda berhasil melakukan Cancel pada prospect no ".$doc_no;
                    $st = 'OK';
                    $image = "approved.png";
                } else {
                    $msg = "Anda gagal melakukan cancel pada prospect no ".$doc_no;
                    $st = 'OK';
                    $image = "reject.png";
                }
            }
            $msg1 = array(
                "Pesan" => $msg,
                "St" => $st,
                "image" => $image
            );
        }
        return view("emails.after", $msg1);
    }
}