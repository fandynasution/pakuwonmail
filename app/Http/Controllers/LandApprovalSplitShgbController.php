<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\LandApprovalSplitShgbMail;
use App\Mail\UserEmail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LandApprovalSplitShgbController extends Controller
{
    public function Mail(Request $request) {
        $callback = array(
            'data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status' => 200
        );

        $list_of_shgb_no = explode(';', $request->shgb_no);

        $shgb_no_data = [];
        foreach ($list_of_shgb_no as $shgb_no) {
            $shgb_no_data[] = $shgb_no;
        }

        $list_of_shgb_no_bpn = explode(';', $request->shgb_no_bpn);

        $shgb_no_bpn_data = [];
        foreach ($list_of_shgb_no_bpn as $shgb_no_bpn) {
            $shgb_no_bpn_data[] = $shgb_no_bpn;
        }

        $list_of_nop_no = explode(';', $request->nop_no);

        $nop_no_data = [];
        foreach ($list_of_nop_no as $nop_no) {
            $nop_no_data[] = $nop_no;
        }

        $list_of_nib_no = explode(';', $request->nib_no);

        $nib_no_data = [];
        foreach ($list_of_nib_no as $nib_no) {
            $nib_no_data[] = $nib_no;
        }

        $list_of_shgb_date = explode(';', $request->shgb_date);

        $shgb_date_data = [];
        foreach ($list_of_shgb_date as $shgb_date) {
            $shgb_date_data[] = Carbon::createFromFormat('M  j Y h:iA', $shgb_date)->format('d-m-Y');
        }

        $list_of_shgb_expired = explode(';', $request->shgb_expired);

        $shgb_expired_data = [];
        foreach ($list_of_shgb_expired as $shgb_expired) {
            $shgb_expired_data[] = Carbon::createFromFormat('M  j Y h:iA', $shgb_expired)->format('d-m-Y');
        }

        $list_of_shgb_area = explode(';', $request->shgb_area);

        $shgb_area_data = [];
        foreach ($list_of_shgb_area as $shgb_area) {
            $shgb_area_data[] = number_format((float)$shgb_area, 2, '.', ',');
        }

        $list_of_urls = explode(";", trim(str_replace(' ', '%20', $request->url_link)));

        $url_data = [];
        foreach ($list_of_urls as $url) {
            $url_data[] = trim($url); // Trim any extra spaces around the URL
        }

        $list_of_files = explode(';', $request->file_name);

        $files_data = [];
        foreach ($list_of_files as $file_name) {
            $files_data[] = $file_name;
        }

        $list_of_split_status_dt = explode(';', $request->split_status_dt);

        $split_status_dt_data = [];
        foreach ($list_of_split_status_dt as $split_status_dt) {
            $split_status_dt_data[] = $split_status_dt;
        }

        $shgb_date_split = Carbon::createFromFormat('M  j Y h:iA', $request->shgb_date_split)->format('d-m-Y');
        $shgb_expired_split = Carbon::createFromFormat('M  j Y h:iA', $request->shgb_expired_split)->format('d-m-Y');
        $shgb_area_split = number_format((float)$request->shgb_area_split, 2, '.', ',');
        $remaining_area = number_format((float)$request->remaining_area, 2, '.', ',');

        $dataArray = array(
            'user_id'               => $request->user_id,
            'level_no'              => $request->level_no,
            'entity_cd'             => $request->entity_cd,
            "doc_no"		        => $request->doc_no,
            "shgb_no"		        => $shgb_no_data,
            "shgb_no_bpn"	        => $shgb_no_bpn_data,
            "nop_no"		        => $nop_no_data,
            "nib_no"		        => $nib_no_data,
            "shgb_date"		        => $shgb_date_data,
            "shgb_expired"	        => $shgb_expired_data,
            "shgb_area"		        => $shgb_area_data,
            "split_status_dt"		=> $split_status_dt_data,
            "shgb_no_split"	        => $request->shgb_no_split,
            "shgb_no_bpn_split"	    => $request->shgb_no_bpn_split,
            "nop_no_split"		    => $request->nop_no_split,
            "nib_no_split"		    => $request->nib_no_split,
            "shgb_date_split"		=> $shgb_date_split,
            "shgb_expired_split"    => $shgb_expired_split,
            "shgb_area_split"		=> $shgb_area_split,
            "split_status_hd"		=> $request->split_status_hd,
            "remaining_area"		=> $remaining_area,
            "url_link"              => $url_data,
            "file_name"             => $files_data,
            "email_addr"            => $request->email_addr,
            "user_name"             => $request->user_name,
            "sender_name"           => $request->sender_name,
            "descs"                 => $request->descs,
            "link"                  => "landapprovalsplitshgb",
        );

        try {
            $sendToEmail = strtolower($request->email_addr);
            $doc_no = $request->doc_no;
            $entity_cd = $request->entity_cd;
            if(isset($sendToEmail) && !empty($sendToEmail) && filter_var($sendToEmail, FILTER_VALIDATE_EMAIL))
            {
                Mail::to($sendToEmail)->send(new LandApprovalSplitShgbMail($dataArray));
                Log::channel('sendmailapproval')->info('Email doc_no ' . $doc_no . ' Entity ' . $entity_cd . ' berhasil dikirim ke: ' . $sendToEmail);
                return "Email berhasil dikirim";
            }
        } catch (\Exception $e) {
            // Tangani kesalahan jika pengiriman email gagal
            Log::error('Gagal mengirim email: ' . $e->getMessage());
        }
    }

    public function changestatus($status='', $entity_cd='', $doc_no='', $level_no='')
    {
        $where2 = array(
            'doc_no'        => $doc_no,
            'status'        => array("A",'R', 'C'),
            'entity_cd'     => $entity_cd,
            'level_no'      => $level_no,
            'type'          => 'Q',
            'module'        => 'LM',
        );

        $where3 = array(
            'doc_no'        => $doc_no,
            'entity_cd'     => $entity_cd,
            'level_no'      => $level_no,
            'type'          => 'Q',
            'module'        => 'LM',
        );
        $query = DB::connection('SSI')
        ->table('mgr.cb_cash_request_appr')
        ->where($where2)
        ->get();

        $query3 = DB::connection('SSI')
        ->table('mgr.cb_cash_request_appr')
        ->where($where3)
        ->get();
        if(count($query)>0){
            $msg = 'You Have Already Made a Request to Approval Land Split SHGB Doc. No. '.$doc_no ;
            $notif = 'Restricted !';
            $st  = 'OK';
            $image = "double_approve.png";
            $msg1 = array(
                "Pesan" => $msg,
                "St" => $st,
                "notif" => $notif,
                "image" => $image
            );
            return view("emails.after", $msg1);
        } else {
            if ($status == 'A') {
                $name   = 'Approval';
                $bgcolor = '#40de1d';
                $valuebt  = 'Approve';
            }else if ($status == 'R') {
                $name   = 'Revision';
                $bgcolor = '#f4bd0e';
                $valuebt  = 'Revise';
            } else if ($status == 'C'){
                $name   = 'Cancelation';
                $bgcolor = '#e85347';
                $valuebt  = 'Cancel';
            }
            $data = array(
                'entity_cd'     => $entity_cd, 
                'doc_no'        => $doc_no, 
                'status'        => $status,
                'level_no'      => $level_no, 
                'name'          => $name,
                'bgcolor'       => $bgcolor,
                'valuebt'       => $valuebt
            );
        }
        return view('emails/landsplitshgb/action', $data);
    }

    public function update(Request $request)
    {
        $entity_cd = $request->entity_cd;
        $doc_no = $request->doc_no;
        $status = $request->status;
        $level_no = $request->level_no;
        $remarks = $request->remarks;
        if ($status == 'A') {
            $descstatus = "Approved";
            $notifdesc = "Approved !";
            $imagestatus = "approved.png";
        } else if ($status == 'R') {
            $descstatus = "Made a Revise Request on";
            $notifdesc = "Revised !";
            $imagestatus = "revise.png";
        } else {
            $descstatus = "Cancelled";
            $notifdesc = "Cancelled !";
            $imagestatus = "reject.png";
        }

        $pdo = DB::connection('SSI')->getPdo();
        $sth = $pdo->prepare("SET NOCOUNT ON; EXEC mgr.xrl_send_mail_approval_land_split_shgb ?, ?, ?, ?, ?;");
        $sth->bindParam(1, $entity_cd);
        $sth->bindParam(2, $doc_no);
        $sth->bindParam(3, $status);
        $sth->bindParam(4, $level_no);
        $sth->bindParam(5, $remarks);
        $sth->execute();
        if ($sth == true) {
            $msg = "You Have Successfully ".$descstatus." the Approval Land Split SHGB Doc. No. ".$doc_no;
            $notif = $descstatus;
            $st = 'OK';
            $image = $imagestatus;
        } else {
            $msg = "You Failed to ".$descstatus." the Approval Land Split SHGB Doc. No ".$doc_no;
            $notif = 'Fail to '.$descstatus;
            $st = 'OK';
            $image = "reject.png";
        }
        $msg1 = array(
            "Pesan" => $msg,
            "St" => $st,
            "image" => $image,
            "notif" => $notif
        );
        return view("emails.after", $msg1);
    }
}