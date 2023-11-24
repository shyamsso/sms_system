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

@section('page-script')
<script src="{{asset('assets/js/app-access-sms.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-2">Send Message</h4>
<div class="col-md-12">
  <div class="card mb-4">
    <div class="card-body">
      <div class="mt-2 mb-3">
        <label for="largeSelect" class="form-label">Account</label>
        <select id="acountSelect" class="form-select form-select-lg">
          @foreach($clientSms as $ClientSmsList)
          <option value="{{ $ClientSmsList->id }}" {{ $ClientSmsList->id == $apikey ? 'selected' : '' }}>{{ $ClientSmsList->apikey }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
</div>
<!-- SMS cards -->
  <div class="col-12">
    <!-- SMS Send -->
    <div class="col-xl">
      <div class="card mb-4">
          <div class="card-body">
              <form action="{{ route('sms_managment.sendsms') }}" method="POST">
                @csrf
                  <input type="hidden" name="clientid" value="{{$clientId}}">
                  <input type="hidden" name="apiKey" value="{{$apikey}}">
                  <div class="mt-3">
                    <label class="form-label" for="phone">My Number</label>
                    <div class="row">
                      <div class="col-md-12">
                        <select class="form-select" id="mynumber" name="mynumber" aria-label="Default select example">
                          <option selected="">Select My Number</option>
                          @foreach($clientNumber as $list)
                            <option value="{{ $list->country_code }} {{ $list->number }}">{{ $list->country_code }} {{ $list->number }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                  <div class="col-md">
                    <div class="form-check form-check-inline mt-3">
                      <input class="form-check-input" type="radio" name="type" id="type" value="single" checked>
                      <label class="form-check-label" for="type">Single Message</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="type" id="type" value="multiple">
                      <label class="form-check-label" for="type">Bluk Message</label>
                    </div>
                  </div>
                  <div class="mt-3" id="single">
                      <label class="form-label" for="phone">Phone No</label>
                      <div class="row">
                        <div class="col-md-2">
                          <select class="form-select" id="countrycode" name="countrycode" aria-label="Default select example">
                            <option selected="">Select Country Code</option>
                            @foreach($Country as $list)
                              <option value="{{ $list->phonecode }}">{{ $list->phonecode }}({{ $list->nicename }})</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-10">
                          <input type="number" id="phone" name="phone" class="form-control phone-mask @error('phone') is-invalid @enderror" maxlength="10" placeholder="658 799 8941" />
                        </div>
                      </div>
                      @error('phone')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="row mt-3">
                      <div class="col-md-6 mb-3 multipleshow"style="display: none;">
                        <label for="exampleFormControlSelect2" class="form-label">Send Message to Multiple</label>
                        <select multiple="" class="form-select js-example-basic-multiple" name="multiplenumber[]" id="exampleFormControlSelect2" aria-label="Multiple select example">
                          @foreach($users as $usersList)
                          <option value="{{$usersList->country_code}}{{$usersList->phone}}">{{$usersList->country_code}} {{$usersList->phone}}({{$usersList->name}})</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-6 mb-3 multipleshow" style="display: none;">
                        <label for="exampleFormControlSelect2" class="form-label"></label>
                        <div class="form-check mt-3 multipleshow">
                          <input class="form-check-input" type="checkbox" value="" id="checkbox">
                          <label class="form-check-label" for="defaultCheck1">
                            Select All
                          </label>
                        </div>
                      </div>
                  </div>
                  <div class="mb-3">
                      <label class="form-label" for="basic-default-message">Message</label>
                      <textarea id="basic-default-message" class="form-control @error('message') is-invalid @enderror" name="message" placeholder="Hi, Do you have a moment to talk Joe?"></textarea>
                      @error('message')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  <button type="submit" class="btn btn-primary">Send</button>
              </form>
          </div>
      </div>
    </div>
    <!--/ SMS Send -->
  </div>
</div>
<!--/ SMS cards -->

<script>
  $(document).ready(function() {
      $("input[name$='type']").click(function() {
          var type = $(this).val();
          if(type == "multiple"){
            $("#single").hide();
            $(".multipleshow").show();
          }else{
            $("#single").show();
            $(".multipleshow").hide();
          }

      });
  });
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2({
      tags: true,
    });
  });
  $("#checkbox").click(function(){
    if($("#checkbox").is(':checked') ){
        $("#exampleFormControlSelect2 > option").prop("selected","selected");
        $("#exampleFormControlSelect2").trigger("change");
    }else{
        $("#exampleFormControlSelect2 > option").removeAttr("selected");
        $("#exampleFormControlSelect2").trigger("change");
    }
  });
</script>
@endsection
