<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sms;
use App\Models\ClientSms;
use App\Models\ClientNumber;
use Vonage\Client;
use Illuminate\Support\Facades\Log;

use Psr\Http\Message\ServerRequestInterface as VonageRequest;
use Psr\Http\Message\ResponseInterface as VonageResponse;

class SmsController extends Controller
{
  public function index(Request $request)
  {
    $authorization = $request->header('authorization');
    $auth = explode(' ', $authorization);
    $decodedAuth = base64_decode($auth['1']);
    $authpass = explode(':', $decodedAuth);
    $authapikey = $authpass['0'];
    $authapiscreate = $authpass['1'];
    $mynumber = $request->from;
    $recivernumber = $request->to;
    $message = $request->message;
    $clientdetail = ClientSms::where('apikey', $authapikey)->first();
    if (!empty($clientdetail)) {
      $clientId = $clientdetail->clientId;
      $getClientData = User::where('id', $clientId)->first();
      $commitionamount = $getClientData->commition_amount;
      $basic = new \Vonage\Client\Credentials\Basic($authapikey, $authapiscreate);
      $client = new \Vonage\Client($basic);
      $response = $client->sms()->send(new \Vonage\SMS\Message\SMS($recivernumber, $mynumber, $message));

      foreach ($response as $value) {
        $data['network'] = $value->getNetwork();
        $data['accountRef'] = $value->getaccountRef();
        $data['clientRef'] = $value->getclientRef();
        $data['messageId'] = $value->getmessageId();
        $data['messagePrice'] = $value->getmessagePrice();
        $data['remainingBalance'] = $value->getremainingBalance();
        $data['status'] = $value->getstatus();
        $data['to'] = $value->getto();
      }

      $mesageamount = $data['messagePrice'];
      $result = ($commitionamount / 100) * $mesageamount;
      $commitionamountmsg = $result + $mesageamount;
      $respo = json_encode($data);
      $status = 'Active';
      User::where('id', $clientId)->decrement('wallt', $commitionamountmsg);
      $dataSingle = [
        'senderid' => $mynumber,
        'reciverid' => $recivernumber,
        'message' => $message,
        'status' => $status,
        'response' => $respo,
        'clientId' => $clientId,
        'messageId' => $data['messageId'],
        'delivery_status' => 'Sent',
        'message_amount' => $data['messagePrice'],
        'message_comision_amount' => $commitionamountmsg,
      ];
      $sms = Sms::create($dataSingle);
      $status = true;
      $textmessagesms = 'Message sent successfully';
    } else {
      $status = false;
      $textmessagesms = 'Your Key Not Vaid';
    }
    return response()->json(['status' => $status, 'message' => $textmessagesms]);
  }
}
