<?php

namespace App\Http\Controllers\admin\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use Auth;
use Stripe\Stripe;
use Stripe\Customer;

class PaymentController extends Controller
{
  public function index()
  {
    $userId = Auth::id();
    $payments = Payment::where('clientId', $userId)->get();
    return view('payment.payment', compact('payments'));
  }

  public function addAmount()
  {
    $userdetail = Auth::user();

    $stripeCustomer = $userdetail->createOrGetStripeCustomer();

    $paymentMethods = $userdetail->paymentMethods();
    $defaultpaymentMethod = $userdetail->defaultPaymentMethod();
    if (!empty($defaultpaymentMethod)) {
      $defaultcardid = $defaultpaymentMethod->id;
    } else {
      $defaultcardid = '';
    }

    return view('payment.add', compact('paymentMethods', 'defaultpaymentMethod', 'defaultcardid'));
  }

  public function addCard()
  {
    $userdetail = Auth::user();

    $stripeCustomer = $userdetail->createOrGetStripeCustomer();

    $url = $userdetail->billingPortalUrl(route('payment.addamount'));

    return redirect($url);
  }

  public function store(Request $request)
  {
    $userId = Auth::id();

    $user = User::find($userId);
    $oldAmount = $user->wallt;
    $paymentmethord = $request->paymentmethord;
    $add_amount = $request->add_amount;

    $stripeCharge = $request->user()->charge($add_amount, $paymentmethord);

    $transictionId = $stripeCharge->id;
    $amount = $stripeCharge->amount;
    $status = $stripeCharge->status;

    $payment = new Payment();
    $payment->clientId = $userId;
    $payment->transictonId = $transictionId;
    $payment->amount = $amount;
    $payment->status = $status;
    $payment->save();

    $newamount = $oldAmount + $amount;

    User::where('id', $userId)->update(['wallt' => $newamount]);

    return redirect()->route('payment.index');
  }
}
