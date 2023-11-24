@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
<style>
  span.select2.select2-container.select2-container--default{
      width: 100% !important;
  }
</style>

@section('title', 'SMS - Apps')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>

<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection


@section('content')

<h4 class="py-3 mb-2">Add Amount</h4>
<!-- SMS cards -->
  <div class="col-12">
    <!-- SMS Send -->
    <div class="col-xl">
      <div class="card mb-4">
          <div class="card-body">
            <form action="{{ route('payment.store') }}" method="POST">
              @csrf
              <div class="row mb-3">
                <input type="hidden" name="paymentmethord" value="{{$defaultcardid}}">
                <label class="col-sm-2 col-form-label" for="add_amount">Add Amount</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="add_amount" name="add_amount" value="0" min="0" placeholder="0">
                </div>
              </div>
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
    <!--/ SMS Send -->
  </div>


<h4 class="py-3 mb-2">Add Card</h4>
<!-- SMS cards -->
  <div class="col-12">
    <!-- SMS Send -->
    <div class="col-xl">
      <div class="card mb-4">
          <div class="card-body">
            <a href="{{url('/payment/addCard')}}" class="btn btn-primary">Add Card</a>
          </div>
      </div>
    </div>
    <!--/ SMS Send -->
  </div>


  <!-- card list -->
<h4 class="py-3 mb-2">Card List</h4>
<!-- SMS cards -->
  <div class="col-12">
    <!-- SMS Table -->
    <div class="card">
      <div class="card-datatable table-responsive">
        <table class="datatables-sms table border-top">
          <thead>
            <tr>
              <th>Card Last 4 digit</th>
              <th>Type</th>
              <th>Exp. Date</th>
              <th>Default</th>
            </tr>
          </thead>
          <tbody>
            @foreach($paymentMethods as $paymentValue)
            <tr>
              <th>{{ $paymentValue->card->last4 }}</th>
              <th>{{ $paymentValue->card->brand }}</th>
              <th>{{ $paymentValue->card->exp_month }}/{{ $paymentValue->card->exp_year }}</th>
              <th>
                @if ($paymentValue->id == $defaultcardid)
                  <button type="button" class="btn rounded-pill btn-primary">Default</button>
                @endif
              </th>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!--/ SMS Table -->
  </div>
</div>
<!--/ SMS cards -->
<script src="https://js.stripe.com/v3/"></script>
<script>
  $( document ).ready(function() {
      var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');
      console.log(stripe);
  });
</script>
@endsection
