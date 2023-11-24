@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Api Key - List')

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
    margin-left: 77%;
  }
</style>
<div class="row">
  <div class="col-md-6">
    <h4 class="py-3 mb-2">Client Api Key</h4>
  </div>
  <div class="col-md-6">
    <a href="{{ route('sms_key.add', $clientId) }}" class="btn btn-primary addnumberleft">Add Api Key</a>
  </div>
</div>
<!-- SMS cards -->
  <div class="col-12">
    <!-- SMS Table -->
    <div class="card">
      <div class="card-datatable table-responsive">
        <table class="datatables-sms table border-top">
          <thead>
            <tr>
              <th>Client Name</th>
              <th>Api Key</th>
              <th>Api Secret</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ClientSms as $ClientSmsList)
            <tr>
              <th>{{ $ClientSmsList->name }}</th>
              <th>{{ $ClientSmsList->apikey }}</th>
              <th>{{ $ClientSmsList->apisecret }}</th>
              <th>
                @if ($ClientSmsList->status == "Inactive")
                  <button type="button" class="btn btn-warning">Inactive</button>
                @else
                  <button type="button" class="btn btn-success">Active</button>
                @endif
              </th>
              <th>
                <a href="{{ route('sms_key.edit', $ClientSmsList->id) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                <button type="button" class="btn btn-danger deleteRecord" data-id="{{ $ClientSmsList->id }}"><i class="fa-solid fa-trash"></i></button>
                @if ($ClientSmsList->status == "Inactive")
                  <button type="button" class="btn btn-success changeStatus" data-id="{{ $ClientSmsList->id }}" data-status="Active">Active</button>
                @else
                <button type="button" class="btn btn-warning changeStatus" data-id="{{ $ClientSmsList->id }}" data-status="Inactive">Inactive</button>
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
<script>
  $(".deleteRecord").click(function(){
      var id = $(this).data("id");
      var token = $("meta[name='csrf-token']").attr("content");
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax(
          {
              url: "/sms_key/delete",
              type: 'POSt',
              data: {
                  "id": id,
                  "_token": token,
              },
              success: function(response) {
                Swal.fire({
                  title: "Deleted!",
                  text: "Your file has been deleted.",
                  icon: "success"
                });
                location.reload();
              },
          });
        }
      });
  });


  $(".changeStatus").click(function(){
      var id = $(this).data("id");
      var status = $(this).data("status");
      var token = $("meta[name='csrf-token']").attr("content");
      Swal.fire({
        title: "Are you sure?",
        text: "You Want to change status!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!"
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax(
          {
              url: "/sms_key/status",
              type: 'POSt',
              data: {
                  "id": id,
                  "status": status,
                  "_token": token,
              },
              success: function(response) {
                Swal.fire({
                  title: "Status!",
                  text: "Your Status has change.",
                  icon: "success"
                });
                location.reload();
              },
          });
        }
      });
  });
</script>
@endsection
