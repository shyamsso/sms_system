<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ClientNumber;
use App\Models\ClientSms;
use Auth;
use session;

class DashboardController extends Controller
{
  public function index(Request $request)
  {
    $userId = Auth::id();
    $amount = $user = Auth::user()->wallt;
    if (auth()->user()->roles == 'Admin') {
      $ClientSms = '';
      $ClientNumber = '';
      $TotalClientNumber = '';
      $ActiveClientCount = '';
      $InActiveClientCount = '';
    } else {
      $ClientSms = ClientSms::where('clientId', $userId)->get();
      if (!empty($ClientSms)) {
        $clientsmsid = $ClientSms['0']->id;
        $request->session()->put('apikey', $clientsmsid);
      } else {
        $clientsmsid = '';
      }
      $ClientNumber = ClientNumber::where('clientId', $userId)
        ->where('apiId', $clientsmsid)
        ->get();
      $TotalClientNumber = ClientNumber::where('clientId', $userId)->count();
      $ActiveClientCount = ClientNumber::where('status', 'Active')
        ->where('clientId', $userId)
        ->count();
      $InActiveClientCount = ClientNumber::where('status', 'InActive')
        ->where('clientId', $userId)
        ->count();
    }

    return view(
      'dashboard.dashboard',
      compact('ClientNumber', 'TotalClientNumber', 'ActiveClientCount', 'InActiveClientCount', 'amount', 'ClientSms')
    );
  }
  public function getmymember(Request $request)
  {
    if (auth()->user()->roles == 'Admin') {
      $userId = $request->userID;
    } else {
      $userId = Auth::id();
    }
    $apiid = $request->selectedValue;
    $request->session()->put('apikey', $apiid);
    $ClientNumber = ClientNumber::where('clientId', $userId)
      ->where('apiId', $apiid)
      ->get();

    return response()->json($ClientNumber);
  }
}
