<?php

namespace App\Http\Controllers\admin\sms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sms;
use App\Models\Country;
use App\Models\ClientSms;
use App\Models\ClientNumber;
use Auth;
use Vonage\Client;
use Illuminate\Support\Facades\Log;

use Psr\Http\Message\ServerRequestInterface as VonageRequest;
use Psr\Http\Message\ResponseInterface as VonageResponse;

class SmsController extends Controller
{
  public function index()
  {
    $userId = Auth::id();
    $users = User::get();
    $sms = Sms::where('clientId', '=', $userId)->get();
    return view('sms.sms', compact('users', 'sms'));
  }

  public function sendMessage(Request $request)
  {
    $clientId = $userId = Auth::id();
    $apikey = $request->session()->get('apikey');
    $clientSms = ClientSms::where('clientId', $clientId)->get();
    $clientNumber = ClientNumber::where('apiId', $apikey)->get();

    $Country = Country::orderBy('nicename', 'asc')->get();
    $users = User::where('roles', 'User')
      ->where('phone', '!=', [Auth::user()->phone])
      ->get();
    return view('sms.smsadd', compact('users', 'Country', 'clientSms', 'apikey', 'clientId', 'clientNumber'));
  }

  public function store(Request $request)
  {
    $type = $request->type;
    $clientid = $request->clientid;
    $apiKey = $request->apiKey;
    $mynumber = $request->mynumber;
    $apiKeysecrete = ClientSms::find($apiKey);
    $apikey = $apiKeysecrete->apikey;
    $apisecret = $apiKeysecrete->apisecret;
    $senderphone = Auth::user()->country_code . Auth::user()->phone;
    if ($request->type == 'single') {
      $validated = $request->validate([
        'phone' => 'required',
        'message' => 'required',
      ]);
      $reciverid = $request->countrycode . $request->phone;
      try {
        $vonage = app('Vonage\Client');
        $text = new \Vonage\SMS\Message\SMS($reciverid, $senderphone, $request->message);
        $textmessage = $vonage->sms()->send($text);
        $message = $textmessage;

        foreach ($message as $value) {
          $data['network'] = $value->getNetwork();
          $data['accountRef'] = $value->getaccountRef();
          $data['clientRef'] = $value->getclientRef();
          $data['messageId'] = $value->getmessageId();
          $data['messagePrice'] = $value->getmessagePrice();
          $data['remainingBalance'] = $value->getremainingBalance();
          $data['status'] = $value->getstatus();
          $data['to'] = $value->getto();
        }
        $responce = json_encode($data);
        $status = 'Active';
      } catch (\Exception $e) {
        $textmessage = $e;
        $responce = json_encode($textmessage);
        $status = 'InActive';
      }
      $dataSingle = [
        'senderid' => $senderphone,
        'reciverid' => $reciverid,
        'message' => $request->message,
        'status' => $status,
        'response' => $responce,
        'clientId' => $clientid,
      ];
      Sms::create($dataSingle);
    } else {
      $reciverphone = $request->multiplenumber;
      $validated = $request->validate([
        'multiplenumber' => 'required',
        'message' => 'required',
      ]);
      foreach ($reciverphone as $key => $phonevalue) {
        try {
          $vonage = app('Vonage\Client');
          $text = new \Vonage\SMS\Message\SMS($phonevalue, $senderphone, $request->message);
          $textmessage = $vonage->sms()->send($text);
          $message = $textmessage;

          foreach ($message as $value) {
            $data['network'] = $value->getNetwork();
            $data['accountRef'] = $value->getaccountRef();
            $data['clientRef'] = $value->getclientRef();
            $data['messageId'] = $value->getmessageId();
            $data['messagePrice'] = $value->getmessagePrice();
            $data['remainingBalance'] = $value->getremainingBalance();
            $data['status'] = $value->getstatus();
            $data['to'] = $value->getto();
          }
          $textmessage = 'Message sent successfully';
          $responce = json_encode($data);
          $status = 'Active';
        } catch (\Exception $e) {
          $textmessage = 'sms not send';
          $responce = json_encode($textmessage);
          $status = 'InActive';
          $flashstatus = 'error';
        }
        $dataMultiple = [
          'senderid' => $senderphone,
          'reciverid' => $phonevalue,
          'message' => $request->message,
          'status' => $status,
          'response' => $responce,
          'clientId' => $clientid,
        ];
        Sms::create($dataMultiple);
      }
    }
    if ($status == 'InActive') {
      $textmessagesms = 'sms not send';
      $flashstatus = 'error';
    } else {
      $textmessagesms = 'Message sent successfully';
      $flashstatus = 'success';
    }
    return redirect()
      ->route('sms_managment.index')
      ->with($flashstatus, $textmessagesms);
  }

  public function sendsms(Request $request)
  {
    $type = $request->type;
    $clientid = $request->clientid;
    $apiKey = $request->apiKey;
    $mynumber = $request->mynumber;
    $sendmessage = $request->message;
    $apiKeysecrete = ClientSms::find($apiKey);
    $apikeyselect = $apiKeysecrete->apikey;
    $apisecretselect = $apiKeysecrete->apisecret;
    if ($request->type == 'single') {
      $countrycode = $request->countrycode;
      $phone = $request->phone;
      $reciverphone = $countrycode . $phone;
      try {
        $getClientData = User::where('id', $clientId)->first();
        $commitionamount = $getClientData->commition_amount;
        $basic = new \Vonage\Client\Credentials\Basic($apikeyselect, $apisecretselect);
        $client = new \Vonage\Client($basic);
        $response = $client->sms()->send(new \Vonage\SMS\Message\SMS($reciverphone, $mynumber, $sendmessage));
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
        $message = json_encode($data);
        $status = 'Active';
        User::where('id', $clientid)->decrement('wallt', $commitionamountmsg);
      } catch (\Exception $e) {
        $textmessage = $e;
        $message = json_encode($textmessage);
        $status = 'InActive';
      }
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
    } else {
      $reciverphone = $request->multiplenumber;
      foreach ($reciverphone as $key => $phonevalue) {
        try {
          $clientId = $clientdetail->clientId;
          $getClientData = User::where('id', $clientId)->first();
          $commitionamount = $getClientData->commition_amount;
          $basic = new \Vonage\Client\Credentials\Basic($apikeyselect, $apisecretselect);
          $client = new \Vonage\Client($basic);
          $response = $client->sms()->send(new \Vonage\SMS\Message\SMS($phonevalue, $mynumber, $sendmessage));
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

          User::where('id', $clientid)->decrement('wallt', $commitionamountmsg);
          $textmessage = 'Message sent successfully';
          $message = json_encode($data);
          $status = 'Active';
        } catch (\Exception $e) {
          $textmessage = 'sms not send';
          $message = json_encode($textmessage);
          $status = 'InActive';
          $flashstatus = 'error';
        }
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
        Sms::create($dataMultiple);
      }
    }
    if ($status == 'InActive') {
      $textmessagesms = 'sms not send';
      $flashstatus = 'error';
    } else {
      $textmessagesms = 'Message sent successfully';
      $flashstatus = 'success';
    }
    return redirect()
      ->route('sms_managment.index')
      ->with($flashstatus, $textmessagesms);
  }

  public function smsWehook(VonageRequest $request, VonageResponse $response)
  {
    \Log::info('sms webhook');
    $sms = \Vonage\SMS\Webhook\Factory::createFromRequest($request);

    //Log::info('From: ' . $sms->getMsisdn() . ' message: ' . $sms->getText());

    return $response->withStatus(204);
  }

  public function smsDeliveryReport(VonageRequest $request, VonageResponse $response)
  {
    //

    $receipt = \Vonage\SMS\Webhook\Factory::createFromRequest($request);

    \Log::info('smsDeliveryReport');
    //\Log::info('getMsisdn:' . $receipt->getMsisdn());
    //error_log(print_r($receipt, true));

    return $response->withStatus(204);
  }

  public function inboundSmsWehook(VonageRequest $request, VonageResponse $response)
  {
    \Log::info('inboundSmsWehook');

    $sms = \Vonage\SMS\Webhook\Factory::createFromRequest($request);

    //Log::info('From: ' . $sms->getMsisdn() . ' message: ' . $sms->getText());

    return $response->withStatus(204);
  }
}
