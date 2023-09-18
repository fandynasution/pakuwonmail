<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSendApproval;
use App\Mail\SalesDeactiveMail;
use App\Mail\UserEmail;
use Illuminate\Support\Facades\DB;

class SalesDeactiveController extends Controller
{
    public function SalesDeactiveMail(Request $request) {
        $callback = array(
            'data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status' => 200
        );

        $dataArray = array(
            'user_id'       => $request->user_id,
            'level_no'      => $request->level_no,
            'entity_cd'     => $request->entity_cd,
            'doc_no'        => $request->doc_no,
            'ref_no'        => $request->ref_no,
            'email_addr'    => $request->email_addr,
            'descs'         => $request->descs,
            'user_name'     => $request->user_name,
            'payment_code'  => $request->payment_code,
            'link'          => 'salesdeactive',
            'body'          => 'Please Approve '.$request->descs.', Payment '.$request->ref_no,
        );

        $sendToEmail = strtolower($request->email_addr);
        if(isset($sendToEmail) && !empty($sendToEmail) && filter_var($sendToEmail, FILTER_VALIDATE_EMAIL))
        {
            Mail::to($sendToEmail)
                ->send(new SalesDeactiveMail($dataArray));
            $callback['Error'] = true;
            $callback['Pesan'] = 'sendToEmail';
            echo json_encode($callback);
        }
    }

    public function changestatus($status='', $entity_cd='', $doc_no='', $level_no='', $payment_code='')
    {
        $where2 = array(
            'doc_no'        => $doc_no,
            'status'        => array("A",'R', 'C'),
            'entity_cd'     => $entity_cd,
            'level_no'      => $level_no,
            'type'          => 'A',
            'module'        => 'SA',
        );

        // $where3 = array(
        //     'doc_no'        => $doc_no,
        //     'entity_cd'     => $entity_cd,
        //     'level_no'      => $level_no,
        //     'type'          => 'A',
        //     'module'        => 'SA',
        // );
        $query = DB::connection('SSI')
        ->table('mgr.cb_cash_request_appr')
        ->where($where2)
        ->get();

        // $query3 = DB::connection('SSI')
        // ->table('mgr.cb_cash_request_appr')
        // ->where($where3)
        // ->get();
        if(count($query)>0){
            $msg = 'You Have Already Made a Request to Approval Sales Deactive No. '.$doc_no ;
            $notif = 'Restricted !';
            $st  = 'OK';
            $image = "double_approve.png";
            $msg1 = array(
                "Pesan" => $msg,
                "St" => $st,
                "notif" => $notif,
                "image" => $image
            );
        } else {
            if($status == 'A') {
                $sqlsendemail = "mgr.xrl_send_mail_approval_sales_deactive '" . $entity_cd . "', '" . $doc_no . "', '" . $payment_code . "', '" . $status . "', '" . $level_no . "'";
                $snd = DB::connection('SSI')->insert($sqlsendemail);
                if ($snd == '1') {
                    $msg = "You Have Successfully Approved the Approval Sales Deactive No. ".$doc_no;
                    $notif = 'Approved !';
                    $st = 'OK';
                    $image = "approved.png";
                } else {
                    $msg = "You Failed to Approve the Approval Sales Deactive No ".$doc_no;
                    $notif = 'Fail to Approve !';
                    $st = 'OK';
                    $image = "reject.png";
                }
            } else if($status == 'R'){
                $sqlsendemail = "mgr.xrl_send_mail_approval_sales_deactive '" . $entity_cd . "', '" . $doc_no . "', '" . $payment_code . "', '" . $status . "', '" . $level_no . "'";
                $snd = DB::connection('SSI')->insert($sqlsendemail);
                if ($snd == '1') {
                    $msg = "You Have Successfully Made a Revise Request on Approval Sales Deactive No. ".$doc_no;
                    $notif = 'Revised !';
                    $st = 'OK';
                    $image = "revise.png";
                } else {
                    $msg = "You Failed to Make a Revise Request on Approval Sales Deactive No. ".$doc_no;
                    $notif = 'Fail to Revised !';
                    $st = 'OK';
                    $image = "reject.png";
                }
            } else {
                $sqlsendemail = "mgr.xrl_send_mail_approval_sales_deactive '" . $entity_cd . "', '" . $doc_no . "', '" . $payment_code . "', '" . $status . "', '" . $level_no . "'";
                $snd = DB::connection('SSI')->insert($sqlsendemail);
                if ($snd == '1') {
                    $msg = "You Have Successfully Canceled the Approval Sales Deactive No. ".$doc_no;
                    $notif = 'Canceled !';
                    $st = 'OK';
                    $image = "reject.png";
                } else {
                    $msg = "You Failed to Cancel the Approval Sales Deactive No. ".$doc_no;
                    $notif = 'Fail to Canceled !';
                    $st = 'OK';
                    $image = "reject.png";
                }
            }
            $msg1 = array(
                "Pesan" => $msg,
                "St" => $st,
                "image" => $image,
                "notif" => $notif
            );
        }
        return view("emails.after", $msg1);
    }
}