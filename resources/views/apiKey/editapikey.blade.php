@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
<style>
  span.select2.select2-container.select2-container--default{
      width: 100% !important;
  }
</style>

@section('title', 'Api Key - Edit')

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
<h4 class="py-3 mb-2">Api key</h4>
<!-- SMS cards -->
  <div class="col-12">
    <!-- SMS Send -->
    <div class="col-xl">
      <div class="card mb-4">
          <div class="card-body">
              <form action="{{ route('sms_key.update') }}" method="POST">
                @csrf
                <input type="hidden" name="apikeyid" value="{{$apikey->id}}">
                  <div class="row mb-3">

                      <div class="row mb-3">
                        <div class="col-md-6">
                          <label for="api_key" class="form-label">Api Key</label>
                          <input type="text" id="api_key" name="api_key" value="{{$apikey->apikey}}" class="form-control phone-mask @error('api_key') is-invalid @enderror" placeholder="" />
                        </div>
                        <div class="col-md-6">
                          <label for="api_secret" class="form-label">Api Secret</label>
                          <input type="text" id="api_secret" name="api_secret" value="{{$apikey->apisecret}}" class="form-control phone-mask @error('api_secret') is-invalid @enderror" placeholder="" />
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
