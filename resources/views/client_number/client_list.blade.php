@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

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
<style>
  .addnumberleft{
    margin-left: 69%;
  }
</style>
<div class="row">
  @if (auth()->user()->roles =="Admin")
    <div class="col-md-6">
      <h4 class="py-3 mb-2">Client Number</h4>
    </div>
  @else
    <div class="col-md-6">
      <h4 class="py-3 mb-2">My Number</h4>
    </div>
  @endif
  @if(auth()->user()->roles =="Admin")
    <div class="col-md-6">
      <a href="{{ route('client_number.add', $clientId) }}" class="btn btn-primary addnumberleft">Add Client Number</a>
    </div>
  @endif
</div>

<div class="col-md-12">
  <div class="card mb-4">
    <div class="card-body">
      <div class="mt-2 mb-3">
        <label for="largeSelect" class="form-label">Account</label>
        <select id="acountSelect" class="form-select form-select-lg">
          @foreach($ClientSms as $ClientSmsList)
          <option value="{{ $ClientSmsList->id }}" {{ $ClientSmsList->id == $apikey ? 'selected' : '' }}>{{ $ClientSmsList->apikey }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
</div>
<!-- SMS cards -->
<div class="row">
  <div class="col-12">
    <!-- SMS Table -->
    <div class="card">
      <div class="card-datatable table-responsive">
        <table class="datatables-sms table border-top" id="DataTables_Table_0">
          <thead>
            <tr>
              <th>Number</th>
              <th>Amount</th>
              <th>Status</th>
              @if(auth()->user()->roles =="Admin")
                <th>Action</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($ClientNumber as $ClientNumberList)
            <tr>
              <th>+{{ $ClientNumberList->country_code }} {{ $ClientNumberList->number }}</th>
              <th>{{ $ClientNumberList->monthy_amount }}</th>
              <th>
                @if ($ClientNumberList->status == "Inactive")
                  <button type="button" class="btn btn-warning">Inactive</button>
                @else
                  <button type="button" class="btn btn-success">Active</button>
                @endif
              </th>
              @if(auth()->user()->roles =="Admin")
              <th>
                <button type="button" class="btn btn-danger deleteRecord" data-id="{{ $ClientNumberList->id }}"><i class="fa-solid fa-trash"></i></button>
                @if ($ClientNumberList->status == "Inactive")
                  <button type="button" class="btn btn-success changeStatus" data-id="{{ $ClientNumberList->id }}" data-status="Active">Active</button>
                @else
                <button type="button" class="btn btn-warning changeStatus" data-id="{{ $ClientNumberList->id }}" data-status="Inactive">Inactive</button>
                @endif
              </th>
              @endif
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
              url: "/client_number/delete",
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
              url: "/client_number/status",
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
@if (auth()->user()->roles =="Client")
<script>
  $(document).ready(function () {
      $('#acountSelect').change(function () {
          var userID = <?php echo $clientId ?>;
          var selectedValue = $(this).val();
          var token = $("meta[name='csrf-token']").attr("content");
          // Perform AJAX request
          $.ajax({
              url: baseUrl+'get-mynumber',
              type: 'POST',
              data: {
                  selectedValue: selectedValue,
                  userID: userID,
                  "_token": token,
              },
              success: function (data) {
                  $("#DataTables_Table_0 tbody").empty();
                  $.each(data, function (index, item) {
                    $('#DataTables_Table_0 tbody').append('<tr><td>'+ item.number +'</td><td>'+ item.monthy_amount +'</td><td>'+ (item.status == "Inactive" ? '<button type="button" class="btn btn-warning">Inactive</button>' : '<button type="button" class="btn btn-success">Active</button>')+ '</td></tr>');
                  });
              },

          });
      });
  });
</script>
@else
<script>
  $(document).ready(function () {
      $('#acountSelect').change(function () {
          var userID = <?php echo $clientId ?>;
          var selectedValue = $(this).val();
          var token = $("meta[name='csrf-token']").attr("content");
          // Perform AJAX request
          $.ajax({
              url: baseUrl+'get-mynumber',
              type: 'POST',
              data: {
                  selectedValue: selectedValue,
                  userID: userID,
                  "_token": token,
              },
              success: function (data) {
                  $("#DataTables_Table_0 tbody").empty();
                  $.each(data, function (index, item) {
                    $('#DataTables_Table_0 tbody').append('<tr><td>'+ item.number +'</td><td>'+ item.monthy_amount +'</td><td>'+ (item.status == "Inactive" ? '<button type="button" class="btn btn-warning">Inactive</button>' : '<button type="button" class="btn btn-success">Active</button>')+ '</td><td>'+ (item.status == "Active" ? '<button type="button" class="btn btn-warning changeStatus" data-id="'+ item.id +'">Inactive</button>' : '<button type="button" class="btn btn-success changeStatus" data-id="'+ item.id +'">Active</button>')+ '<button type="button" class="btn btn-danger deleteRecord" data-id="'+ item.id +'"><i class="fa-solid fa-trash"></i></button></td></tr>');
                  });
              },

          });
      });
  });
</script>
@endif
@endsection
