@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Payment - Apps')

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

@section('page-script')
<script src="{{asset('assets/js/app-access-sms.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-2">Transaction List</h4>
<!-- SMS cards -->
  <div class="col-12">
    <!-- SMS Table -->
    <div class="card">
      <div class="card-datatable table-responsive">
        <table class="datatables-sms table border-top">
          <thead>
            <tr>
              <th>Transaction Id</th>
              <th>Amount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($payments as $paymentsList)
            <tr>
              <th>{{ $paymentsList->transictonId }}</th>
              <th>{{ $paymentsList->amount }}</th>
              <th>{{ $paymentsList->status }}</th>
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
@endsection
