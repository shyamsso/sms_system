<?php

namespace App\Http\Controllers\admin\webhook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vonage\Client;
use App\Models\Sms;

use Psr\Http\Message\ServerRequestInterface as VonageRequest;
use Psr\Http\Message\ResponseInterface as VonageResponse;

class WebHookController extends Controller
{
  public function smsWehook(VonageRequest $request, VonageResponse $response)
  {
    //
    \Log::info('sms webhook');
    $sms = \Vonage\SMS\Webhook\Factory::createFromRequest($request);

    //Log::info('From: ' . $sms->getMsisdn() . ' message: ' . $sms->getText());

    return $response->withStatus(204);
  }

  public function inboundSmsWehook(VonageRequest $request, VonageResponse $response)
  {
    \Log::info('inboundSmsWehook');

    $sms = \Vonage\SMS\Webhook\Factory::createFromRequest($request);

    //Log::info('From: ' . $sms->getMsisdn() . ' message: ' . $sms->getText());

    return $response->withStatus(204);
  }

  public function smsDeliveryReport(VonageRequest $request, VonageResponse $response)
  {
    $receipt = \Vonage\SMS\Webhook\Factory::createFromRequest($request);
    $messageId = $receipt->getmessageId();
    $status = $receipt->getstatus();
    $to = $receipt->getto();
    $riciver = $receipt->getMsisdn();
    $result = Sms::where('messageId', '=', $messageId)->first();

    if (!empty($result)) {
      Sms::where('messageId', '=', $messageId)->update(['delivery_status' => $status]);
    } else {
      $dataSingle = [
        'senderid' => $riciver,
        'reciverid' => $to,
        'messageId' => $messageId,
        'delivery_status' => $status,
      ];
      Sms::create($dataSingle);
    }

    return $response->withStatus(204);
  }
}
