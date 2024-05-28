<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\FeedbackSubmissionMail;
use Illuminate\Support\Facades\DB;

class FeedbackLandSubmissionController extends Controller
{
    public function Mail(Request $request)
    {
        $list_of_urls = explode(';', $request->url_file);

        $url_data = [];
        foreach ($list_of_urls as $url) {
            $url_data[] = $url;
        }

        $list_of_files = explode(';', $request->file_name);

        $file_data = [];
        foreach ($list_of_files as $file) {
            $file_data[] = $file;
        }

        $list_of_type = explode(';', $request->type);

        $type_data = [];
        foreach ($list_of_type as $type) {
            $type_data[] = $type;
        }

        $list_of_owner = explode(';', $request->owner);

        $owner_data = [];
        foreach ($list_of_owner as $owner) {
            $owner_data[] = $owner;
        }

        $list_of_nop_no = explode(';', $request->nop_no);

        $nop_no_data = [];
        foreach ($list_of_nop_no as $nop_no) {
            $nop_no_data[] = $nop_no;
        }

        $list_of_request_amt = explode(';', $request->request_amt);
        
        $request_amt_data = [];
        foreach ($list_of_request_amt as $amt) {
            $formatted_amt = number_format((float)$amt, 2, '.', ',');
            $request_amt_data[] = $formatted_amt;
        }

        $formatted_sum_amt = number_format($request->sum_amt, 2, '.', ',');

        $list_of_approve = explode('; ',  $request->approve_exist);
        $approve_data = [];
        foreach ($list_of_approve as $approve) {
            $approve_data[] = $approve;
        }

        $list_of_approve_date = explode('; ',  $request->approved_date);
        $approve_date_data = [];
        foreach ($list_of_approve_date as $approve_date) {
            $approve_date_data[] = $approve_date;
        }


        $dataArray = array(
            'doc_no'            => $request->doc_no,
            'reason'            => $request->reason,
            'approve_seq'       => $request->approve_seq,
            'descs_send'        => $request->descs_send,
            'subject'           => $request->subject,
            'user_name'         => $request->user_name,
            'sender_name'       => $request->staff_act_send,
            'entity_name'       => $request->entity_name,
            'email_cc'          => $request->email_cc,
            'email_addr'        => $request->email_addr,
            'user_id'           => $request->user_id,
            'level_no'          => $request->level_no,
            'entity_cd'         => $request->entity_cd,
            'type'              => $type_data,
            'owner'             => $owner_data,
            'nop_no'            => $nop_no_data,
            'sph_trx_no'        => $request->sph_trx_no,
            'url_file'          => $url_data,
            'file_name'         => $file_data,
            'request_amt'       => $request_amt_data,
            'sum_amt'           => $formatted_sum_amt,
            'approve_list'      => $approve_data,
            'approved_date'     => $approve_date_data,
            'descs'             => $request->descs,
        );

        try {
            $emailAddresses = strtolower($request->email_addr);
            $doc_no = $request->doc_no;
            $entity_cd = $request->entity_cd;
            $status = $request->status;
            $approve_seq = $request->approve_seq;
            // Check if email addresses are provided and not empty
            if (!empty($emailAddresses)) {
                $emails = is_array($emailAddresses) ? $emailAddresses : [$emailAddresses];

                $emailSent = false;
                
                foreach ($emails as $email) {
                    // Check if the email has been sent before for this document
                    $cacheFile = 'email_feedback_sent_' . $approve_seq . '_' . $entity_cd . '_' . $doc_no . '_' . $status . '.txt';
                    $cacheFilePath = storage_path('app/mail_cache/feedbacksubmission/' . date('Ymd'). '/' . $cacheFile);
                    $cacheDirectory = dirname($cacheFilePath);
                
                    // Ensure the directory exists
                    if (!file_exists($cacheDirectory)) {
                        mkdir($cacheDirectory, 0755, true);
                    }
                
                    if (!file_exists($cacheFilePath)) {
                        // Send email
                        Mail::to($email)->send(new FeedbackSubmissionMail($dataArray));
                
                        // Mark email as sent
                        file_put_contents($cacheFilePath, 'sent');
                        $sentTo = is_array($emailAddresses) ? implode(', ', $emailAddresses) : $emailAddresses;
                        Log::channel('sendmailfeedback')->info('Email Feedback doc_no '.$doc_no.' Entity ' . $entity_cd.' berhasil dikirim ke: ' . $sentTo);
                        return "Email berhasil dikirim ke: " . $sentTo;
                        $emailSent = true;
                    }
                }
            } else {
                Log::channel('sendmail')->warning("Tidak ada alamat email untuk feedback yang diberikan");
                Log::channel('sendmail')->warning($doc_no);
                return "Tidak ada alamat email untuk feedback yang diberikan";
            }
        } catch (\Exception $e) {
            Log::channel('sendmail')->error('Gagal mengirim email: ' . $e->getMessage());
            return "Gagal mengirim email: " . $e->getMessage();
        }
    }
}
