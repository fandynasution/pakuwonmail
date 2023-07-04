<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\NineVarMail;
use Illuminate\Support\Facades\DB;

class CmContractDoneController extends Controller
{
    public function Mail(Request $request) {
        $callback = array(
            'data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status' => 200
        );

        $dataArray = array(
            'entity_cd'     => $request->entity_cd,
            'project_no'    => $request->project_no,
            'doc_no'        => $request->doc_no,
            'ref_no'        => $request->ref_no,
            'level_no'      => $request->level_no,
            'user_id'       => $request->user_id,
            'email_addr'    => $request->email_addr,
            'descs'         => $request->descs,
            'usergroup'     => $request->usergroup,
            'supervisor'    => $request->supervisor,
            'link'          => 'cmcontractdone',
            'body'          => 'Please Approve '.$request->descs,
        );

        $sendToEmail = strtolower($request->email_addr);
        if(isset($sendToEmail) && !empty($sendToEmail) && filter_var($sendToEmail, FILTER_VALIDATE_EMAIL))
        {
            Mail::to($sendToEmail)
                ->send(new NineVarMail($dataArray));
            $callback['Error'] = true;
            $callback['Pesan'] = 'sendToEmail';
            echo json_encode($callback);
        }
    }

    public function changestatus($entity_cd='', $project_no='', $doc_no='', $ref_no='', $status='', $level_no='', $usergroup='', $user_id='', $supervisor='')
    {
        $where2 = array(
            'entity_cd'     =>  $entity_cd,
            'doc_no'        =>  $doc_no,
            'ref_no'        =>  $ref_no,
            'status'        =>  array("A",'R', 'C'),
            'level_no'      =>  $level_no,
            'user_id'       =>  $user_id,
            'type'          =>  'C',
            'module'        =>  'CM'
        );

        $where3 = array(
            'entity_cd'     =>  $entity_cd,
            'doc_no'        =>  $doc_no,
            'ref_no'        =>  $ref_no,
            'status'        =>  'P',
            'level_no'      =>  $level_no,
            'user_id'       =>  $user_id,
            'type'          => 'C',
            'module'        => 'CM',
        );
        $query = DB::connection('SSI')
        ->table('mgr.cb_cash_request_appr')
        ->where($where2)
        ->get();

        $query3 = DB::connection('SSI')
        ->table('mgr.cb_cash_request_appr')
        ->where($where3)
        ->get();
        if(count($query)>0 || count($query3)==0){
            $msg = 'You Have Already Made a Request to CM Contract Done No. '.$doc_no ;
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
                $pdo = DB::connection('SSI')->getPdo();
                $sth = $pdo->prepare("SET NOCOUNT ON; EXEC mgr.xrl_send_mail_approval_cm_contract_done ?, ?, ?, ?, ?, ?, ?, ?, ?;");
                $sth->bindParam(1, $entity_cd);
                $sth->bindParam(2, $project_no);
                $sth->bindParam(3, $doc_no);
                $sth->bindParam(4, $ref_no);
                $sth->bindParam(5, $status);
                $sth->bindParam(6, $level_no);
                $sth->bindParam(7, $usergroup);
                $sth->bindParam(8, $user_id);
                $sth->bindParam(9, $supervisor);
                $sth->execute();
                if ($sth == true) {
                    $msg = "You Have Successfully Approved the CM Contract Done No. ".$doc_no;
                    $notif = 'Approved !';
                    $st = 'OK';
                    $image = "approved.png";
                } else {
                    $msg = "You Failed to Approve the CM Contract Done No ".$doc_no;
                    $notif = 'Fail to Approve !';
                    $st = 'OK';
                    $image = "reject.png";
                }
            } else if($status == 'R'){
                $pdo = DB::connection('SSI')->getPdo();
                $sth = $pdo->prepare("SET NOCOUNT ON; EXEC mgr.xrl_send_mail_approval_cm_contract_done ?, ?, ?, ?, ?, ?, ?, ?, ?;");
                $sth->bindParam(1, $entity_cd);
                $sth->bindParam(2, $project_no);
                $sth->bindParam(3, $doc_no);
                $sth->bindParam(4, $ref_no);
                $sth->bindParam(5, $status);
                $sth->bindParam(6, $level_no);
                $sth->bindParam(7, $usergroup);
                $sth->bindParam(8, $user_id);
                $sth->bindParam(9, $supervisor);
                $sth->execute();
                if ($sth == true) {
                    $msg = "You Have Successfully Made a Revise Request on CM Contract Done No. ".$doc_no;
                    $notif = 'Revised !';
                    $st = 'OK';
                    $image = "revise.png";
                } else {
                    $msg = "You Failed to Make a Revise Request on CM Contract Done No. ".$doc_no;
                    $notif = 'Fail to Revised !';
                    $st = 'OK';
                    $image = "reject.png";
                }
            } else {
                $pdo = DB::connection('SSI')->getPdo();
                $sth = $pdo->prepare("SET NOCOUNT ON; EXEC mgr.xrl_send_mail_approval_cm_contract_done ?, ?, ?, ?, ?, ?, ?, ?, ?;");
                $sth->bindParam(1, $entity_cd);
                $sth->bindParam(2, $project_no);
                $sth->bindParam(3, $doc_no);
                $sth->bindParam(4, $ref_no);
                $sth->bindParam(5, $status);
                $sth->bindParam(6, $level_no);
                $sth->bindParam(7, $usergroup);
                $sth->bindParam(8, $user_id);
                $sth->bindParam(9, $supervisor);
                $sth->execute();
                if ($sth == true) {
                    $msg = "You Have Successfully Canceled the CM Contract Done No. ".$doc_no;
                    $notif = 'Canceled !';
                    $st = 'OK';
                    $image = "reject.png";
                } else {
                    $msg = "You Failed to Cancel the CM Contract Done No. ".$doc_no;
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