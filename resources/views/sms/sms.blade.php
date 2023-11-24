@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

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

@section('page-script')
<script src="{{asset('assets/js/app-access-sms.js')}}"></script>
@endsection

@section('content')
<style>
  .addnumberleft{
    margin-left: 69%;
  }
</style>

<div class="row">
  <div class="col-md-6">
    <h4 class="py-3 mb-2">Sms List</h4>
  </div>
</div>
<!-- SMS cards -->
  <div class="col-12">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- SMS Table -->
    <div class="card">
      <div class="card-datatable table-responsive">
        <table class="datatables-sms table border-top">
          <thead>
            <tr>
              <th>Sender Number</th>
              <th>Reciver Number</th>
              <th>Message</th>
              <th>Amount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sms as $smsList)
            <tr>
              <th>+{{ $smsList->senderid }}</th>
              <th>+{{ $smsList->reciverid }}</th>
              <th>{{ $smsList->message }}</th>
              <th>{{ $smsList->message_comision_amount }}</th>
              <th>{{ $smsList->delivery_status }}</th>
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
