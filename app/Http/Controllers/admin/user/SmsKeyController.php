<?php

namespace App\Http\Controllers\admin\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClientSms;
use Auth;

class SmsKeyController extends Controller
{
  public function index($id)
  {
    $roles = Auth::user()->roles;
    $userId = Auth::id();
    $clientId = $id;

    $ClientSms = ClientSms::select(
      'client_sms.id',
      'client_sms.apikey',
      'client_sms.apisecret',
      'users.name',
      'client_sms.status'
    )
      ->where('clientId', $id)
      ->join('users', 'client_sms.clientId', '=', 'users.id')
      ->get();

    return view('apiKey.apikey_list', compact('ClientSms', 'clientId'));
  }

  public function add($id)
  {
    $clientId = $id;
    $users = User::where('roles', '=', 'Client')->get();
    return view('apiKey.addapikey', compact('users', 'clientId'));
  }

  public function store(Request $request)
  {
    $dataSingle = [
      'clientId' => $request->clientid,
      'apikey' => $request->api_key,
      'apisecret' => $request->api_secret,
    ];
    ClientSms::create($dataSingle);
    return redirect()->route('sms_key.index', $request->clientid);
  }

  public function edit($Id)
  {
    $apikey = ClientSms::where('id', $Id)->first();
    $users = User::where('roles', '=', 'Client')->get();
    return view('apiKey.editapikey', compact('users', 'apikey'));
  }

  public function update(Request $request)
  {
    $apismsid = $request->apikeyid;
    $dataSingle = [
      'clientId' => $request->clientid,
      'apikey' => $request->api_key,
      'apisecret' => $request->api_secret,
    ];
    ClientSms::where('id', $apismsid)->update($dataSingle);
    return redirect()->route('sms_key.index', $request->clientid);
  }

  public function delete(Request $request)
  {
    $id = $request->id;
    ClientSms::find($id)->delete($id);

    return response()->json([
      'success' => 'Record deleted successfully!',
    ]);
  }

  public function status(Request $request)
  {
    $id = $request->id;
    $status = $request->status;
    $dataSingle = [
      'status' => $status,
    ];
    ClientSms::find($id)->update($dataSingle);

    return response()->json([
      'success' => 'Record Status Chnage successfully!',
    ]);
  }
}
