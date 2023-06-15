<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\ApprovalController as ApprovalMail;

Route::post('/mailApproval', [ApprovalMail::class, 'sendApprovalMail']);
Route::GET('/approvestatus/{status}/{entity_cd}/{doc_no}/{level_no}', [ApprovalMail::class, 'changestatus']);