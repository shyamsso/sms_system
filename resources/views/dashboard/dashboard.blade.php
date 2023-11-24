@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/charts-apex.js')}}"></script>
@endsection

@section('title', 'Home')

@section('content')

  <h1>{{Auth::user()->name}}</h1>

  @if(auth()->user()->roles == 'Client')
  @if(!empty($ClientSms))
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="mt-2 mb-3">
          <label for="largeSelect" class="form-label">Account</label>
          <select id="acountSelect" class="form-select form-select-lg">
            @foreach($ClientSms as $ClientSmsList)
            <option value="{{ $ClientSmsList->id }}">{{ $ClientSmsList->apikey }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>
  <!-- Number List -->
  <div class="row mb-4">
    <div class="col-12 order-5">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">My Numbers</h5>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="table-responsive">
                        <table class="dt-route-vehicles table dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1390px;">
                            <thead class="border-top">
                                <tr>
                                    <th class="sorting">Number</th>
                                    <th class="sorting">Monthly Amount</th>
                                    <th class="sorting">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ClientNumber as $ClientNumberList)
                                <tr class="odd">
                                    <td class="sorting_1">
                                        <div class="d-flex justify-content-start align-items-center user-name">
                                            <div class="d-flex flex-column">
                                              {{ $ClientNumberList->country_code }} {{ $ClientNumberList->number }}
                                            </div>
                                        </div>
                                    </td>
                                    <td><div class="text-body">{{ $ClientNumberList->monthy_amount }}</div></td>
                                    <td>
                                      @if($ClientNumberList->status == "Inactive")
                                        <span class="badge rounded bg-label-danger">Inactive</span>
                                      @else
                                      <span class="badge rounded bg-label-success">Active</span>
                                      @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  @endif
  <div class="row mb-3">
    <div class="col-md-3">
      <h4>Credit</h4>
      <div class="col-sm-12 col-lg-12 mb-4">
          <div class="card card-border-shadow-warning h-100">
              <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                      <div class="avatar me-2">
                          <span class="avatar-initial rounded bg-label-warning"><i class='bx bx-group' ></i></span>
                      </div>
                      <h4 class="ms-1 mb-0">{{$amount}}</h4>
                  </div>
                  <p class="mb-1">Remaining Credit</p>
              </div>
          </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="row mb-3">
        <h4>Total Number</h4>
        <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-phone-call' ></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$TotalClientNumber}}</h4>
                    </div>
                    <p class="mb-1">Total Number</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card card-border-shadow-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-success"><i class='bx bx-phone-call' ></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$ActiveClientCount}}</h4>
                    </div>
                    <p class="mb-1">Active Number</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card card-border-shadow-danger h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-danger"><i class='bx bx-phone-off'></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{$InActiveClientCount}}</h4>
                    </div>
                    <p class="mb-1">InActive Number</p>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <h4>Message</h4>
    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-message-dots'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0">42</h4>
                </div>
                <p class="mb-1">Send Message Today</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-message-dots'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0">8</h4>
                </div>
                <p class="mb-1">Send Message Current Month</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-message-dots'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0">8</h4>
                </div>
                <p class="mb-1">Recive Message Today</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-message-dots'></i></span>
                    </div>
                    <h4 class="ms-1 mb-0">8</h4>
                </div>
                <p class="mb-1">Recive Message Month</p>
            </div>
        </div>
    </div>
  </div>
  <!-- Bar Chart -->
  <div class="row mb-3">
    <div class="col-12 mb-4">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-md-center align-items-start">
          <h5 class="card-title mb-0">Usage</h5>
        </div>
        <div class="card-body">
          <div id="barChart"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Bar Chart -->
  @else
  <div class="row mb-4">
    <div class="col-12 order-5">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Comming Soon</h5>
                </div>
            </div>
        </div>
    </div>
  </div>
  @endif
  <script>
   $(document).ready(function () {
      $('#acountSelect').change(function () {
          var selectedValue = $(this).val();
          var token = $("meta[name='csrf-token']").attr("content");
          // Perform AJAX request
          $.ajax({
              url: baseUrl+'get-mynumber',
              type: 'POST',
              data: {
                  selectedValue: selectedValue,
                  "_token": token,
              },
              success: function (data) {
                  $("#DataTables_Table_0 tbody").empty();
                  $.each(data, function (index, item) {
                    $('#DataTables_Table_0 tbody').append('<tr><td>'+ item.number +'</td><td>'+ item.monthy_amount +'</td><td>'+ (item.status == "Inactive" ? '<button type="button" class="badge rounded bg-label-danger">Inactive</button>' : '<button type="button" class="badge rounded bg-label-success">Active</button>')+ '</td></tr>');
                  });
              },

          });
      });
  });
  </script>


@endsection
