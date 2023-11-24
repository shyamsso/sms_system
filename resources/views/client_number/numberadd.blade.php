@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
<style>
  span.select2.select2-container.select2-container--default{
      width: 100% !important;
  }
</style>

@section('title', 'Client Number - Apps')

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
<h4 class="py-3 mb-2">Client Number</h4>
<!-- SMS cards -->
  <div class="col-12">
    <!-- SMS Send -->
    <div class="col-xl">
      <div class="card mb-4">
          <div class="card-body">
              <form action="{{ route('client_number.store', $clientId) }}" method="POST">
                @csrf
                  <div class="row">
                    <input type="hidden" name="clientid" value="{{$clientId}}">
                      <div class="row mb-3">
                        <div class="col-md-12">
                          <label for="apikey" class="form-label">Select Client Api Key</label>
                          <select class="form-select" name="apikey" id="apikey" aria-label="Multiple select example">
                            @foreach($client as $clientList)
                            <option value="{{$clientList->id}}">{{$clientList->apikey}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-2 mb-3">
                          <label for="country_code" class="form-label">Select Country Code</label>
                          <select class="form-select" name="country_code" id="country_code" aria-label="Multiple select example" required>
                            <option value="">Select</option>
                            @foreach($countryList as $phonecodelist)
                            <option value="{{ $phonecodelist->phonecode }}">{{ $phonecodelist->phonecode }}({{ $phonecodelist->nicename }})</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-10 mb-3">
                          <label for="phone" class="form-label">Phone Number</label>
                          <input type="text" id="phone" name="phone" class="form-control phone-mask @error('phone') is-invalid @enderror" placeholder="" required />
                        </div>
                        <div class="col-md-12">
                          <label for="amount" class="form-label">Amount</label>
                          <input type="text" id="amount" name="amount" class="form-control @error('phone') is-invalid @enderror" placeholder="" required />
                        </div>
                      </div>
                  </div>
                  <button type="submit" class="btn btn-primary mb-3">Save</button>
              </form>
          </div>
      </div>
    </div>
    <!--/ SMS Send -->
  </div>
</div>
<!--/ SMS cards -->
@endsection
