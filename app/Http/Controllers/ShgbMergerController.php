<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\ShgbMergerMail;

class ShgbMergerController extends Controller
{
    public function mail(Request $request)
    {
        $list_of_urls = explode(';', $request->url_file);
        $list_of_files = explode(';', $request->file_name);
        $list_of_shgb_ref_no = explode(';', $request->shgb_ref_no);

        $url_data = [];
        $file_data = [];
        $shgb_ref_no_data = [];

        foreach ($list_of_urls as $url) {
            $url_data[] = $url;
        }

        foreach ($list_of_files as $file) {
            $file_data[] = $file;
        }

        foreach ($list_of_shgb_ref_no as $ref_no) {
            $shgb_ref_no_data[] = $ref_no;
        }

        $dataArray = array(
            "user_id"       => $request->user_id,
            "level_no"      => $request->level_no,
            "entity_cd"     => $request->entity_cd,
            "doc_no"        => $request->doc_no,
            "descs"         => $request->descs,
            "merge_ref_no"  => $request->merge_ref_no,
            "merge_nop"     => $request->merge_nop,
            "merge_area"    => $request->merge_area,
            "shgb_ref_no"   => $shgb_ref_no_data,
            "url_file"      => $url_data,
            "file_name"     => $file_data,
            "sender_name"   => $request->sender_name,
            "user_name"     => $request->user_name,
            "link"          => "shgbmerger",
            "subject"       => "Need Approval ".$request->descs
        );
    
        try {
            $emailAddresses = $request->email_addr;
        
            // Check if email addresses are provided and not empty
            if (!empty($emailAddresses)) {
                $emails = is_array($emailAddresses) ? $emailAddresses : [$emailAddresses];
                
                foreach ($emails as $email) {
                    Mail::to($email)->send(new ShgbMergerMail($dataArray));
                }
                
                $sentTo = is_array($emailAddresses) ? implode(', ', $emailAddresses) : $emailAddresses;
                Log::channel('sendmail')->info('Email berhasil dikirim ke: ' . $sentTo);
                return 'Email berhasil dikirim ke: ' .$sentTo;
            } else {
                Log::channel('sendmail')->warning('Tidak ada alamat email yang diberikan.');
                return "Tidak ada alamat email yang diberikan.";
            }
        } catch (\Exception $e) {
            Log::channel('sendmail')->error('Gagal mengirim email: ' . $e->getMessage());
            return "Gagal mengirim email: " . $e->getMessage();
        }
    }

    public function changestatus($entity_cd ='', $doc_no ='', $status='', $level_no='')
    {
        $where = array(
            'doc_no'        => $doc_no,
            'status'        => array("A",'R', 'C'),
            'entity_cd'     => $entity_cd,
            'level_no'      => $level_no,
            'type'          => 'J',
            'module'        => 'LM',
        );
        $query = DB::connection('SSI')
        ->table('mgr.cb_cash_request_appr')
        ->where($where)
        ->get();

        if(count($query)>0){
            $msg = 'You Have Already Made a Request to Land Approval SHGB Merge No. '.$doc_no ;
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
            } else {
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
        return view('emails/shgbmerger/action')->with('data', $data);
    }

    public function update(Request $request)
    {
        $entity_cd  = $request->entity_cd;
        $doc_no     = $request->doc_no;
        $status     = $request->status;
        $level_no   = $request->level_no;
        $remarks    = $request->remarks;
        if ($status == 'A')
        {
            $statusdesc = "Approved";
            $image = "approved.png";
        } else if ($status == 'R')
        {
            $statusdesc = "Revised";
            $image = "revise.png";
        } else 
        {
            $statusdesc = "Cancelled";
            $image = "reject.png";
        }
        $pdo = DB::connection('SSI')->getPdo();
        $sth = $pdo->prepare("SET NOCOUNT ON; EXEC mgr.xrl_send_mail_approval_land_sft_merge_shgb ?, ?, ?, ?, ?;");
        $sth->bindParam(1, $entity_cd);
        $sth->bindParam(2, $doc_no);
        $sth->bindParam(3, $status);
        $sth->bindParam(4, $level_no);
        $sth->bindParam(5, $remarks);
        $sth->execute();
        if ($sth == true) {
            $msg = "You Have Successfully ".$statusdesc." the Land Approval SHGB Merge No. ".$doc_no;
            $notif = $statusdesc.' !';
            $st = 'OK';
            $image = $image;
        } else {
            $msg = "You Failed to ".$statusdesc." the Land Approval SHGB Merge No ".$doc_no;
            $notif = 'Fail to '.$statusdesc.' !';
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
