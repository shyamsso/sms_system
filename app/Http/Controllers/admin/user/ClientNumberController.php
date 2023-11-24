<?php

namespace App\Http\Controllers\admin\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClientNumber;
use App\Models\ClientSms;
use App\Models\Country;
use Auth;

class ClientNumberController extends Controller
{
  public function index(Request $request)
  {
    $roles = Auth::user()->roles;
    $userId = Auth::id();

    if ($roles == 'Client') {
      $ClientSms = ClientSms::where('clientId', $userId)->get();
      $apikey = $request->session()->get('apikey');
      $clientId = $userId;
      $ClientNumber = ClientNumber::select(
        'client_number.id',
        'client_number.country_code',
        'client_number.number',
        'client_number.monthy_amount',
        'users.name',
        'client_number.status'
      )
        ->where('clientId', $userId)
        ->where('apiId', $apikey)
        ->join('users', 'client_number.clientId', '=', 'users.id')
        ->get();
    } else {
      $clientId = $_GET['id'];
      $ClientSms = ClientSms::where('clientId', $clientId)->get();
      $apikey = $request->session()->get('apikey');
      if (!empty($apikey)) {
        $apikey = $request->session()->get('apikey');
      } else {
        $apiKey = $ClientSms['0']->id;
      }
      $ClientNumber = ClientNumber::select(
        'client_number.id',
        'client_number.country_code',
        'client_number.clientId',
        'client_number.number',
        'client_number.monthy_amount',
        'client_number.apiId',
        'users.name',
        'client_number.status'
      )
        ->where('apiId', $apikey)
        ->orWhere('clientId', $clientId)
        ->join('users', 'client_number.clientId', '=', 'users.id')
        ->get();
    }
    return view('client_number.client_list', compact('ClientNumber', 'clientId', 'ClientSms', 'apikey'));
  }

  public function add($id)
  {
    $clientId = $id;
    $users = User::where('roles', '=', 'Client')->get();
    $client = ClientSms::where('clientId', '=', $clientId)->get();
    $countryList = Country::get();
    return view('client_number.numberadd', compact('users', 'clientId', 'client', 'countryList'));
  }

  public function store(Request $request)
  {
    $dataSingle = [
      'clientId' => $request->clientid,
      'apiId' => $request->apikey,
      'country_code' => $request->country_code,
      'number' => $request->phone,
      'monthy_amount' => $request->amount,
    ];
    ClientNumber::create($dataSingle);
    return redirect()->route('client_number.index', ['id' => $request->clientid]);
  }

  public function delete(Request $request)
  {
    $id = $request->id;
    ClientNumber::find($id)->delete($id);

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
    ClientNumber::find($id)->update($dataSingle);

    return response()->json([
      'success' => 'Record Status Chnage successfully!',
    ]);
  }
}
