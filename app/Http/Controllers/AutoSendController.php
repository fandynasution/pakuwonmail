<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutoSendController extends Controller
{
    public function index()
    {
        $query = DB::connection('SSI')
        ->table('mgr.cb_cash_request_appr')
        ->whereNull('sent_mail_date')
        ->where('status', 'P')
        ->whereNotNull('currency_cd')
        ->orderBy('doc_no', 'desc')
        ->get();

        foreach ($query as $data) {
            $entity_cd = $data->entity_cd;
            $exploded_values = explode(" ", $entity_cd);
            $project_no = implode('', $exploded_values) . '01';
            $doc_no = $data->doc_no;
            $trx_type = $data->trx_type;
            $level_no = $data->level_no;
            $user_id = $data->user_id;
            $type = $data->TYPE;
            $module = $data->module;
            $ref_no = $data->ref_no;
            $doc_date = $data->doc_date;
            $dateTime = new DateTime($doc_date);
            $supervisor = 'Y';
            $reason = '0';

            
        }
    }
}
