@extends('layouts/layoutMaster')

@section('title', 'Permission - Apps')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/app-access-permission.js')}}"></script>
<script src="{{asset('assets/js/modal-add-permission.js')}}"></script>
<script src="{{asset('assets/js/modal-edit-permission.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-2">Permissions List</h4>


<!-- Permission Table -->
<div class="card">
  <div class="card-datatable table-responsive">
    <table class="datatables-permissions table border-top">
      <thead>
        <tr>
          <th></th>
          <th>S. No.</th>
          <th>Name</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!--/ Permission Table -->

<!-- Modal -->
@include('_partials/_modals/modal-add-permission')
@include('_partials/_modals/modal-edit-permission')
<!-- /Modal -->


<script type="text/javascript">
    $(document).ready(function () {
      $(".SavePermission").click(function(e){
          e.preventDefault();
          var data = $('#addPermissionForm').serialize();
          console.log(data);

          $.ajax({
                type:'POST',
                url: '{{ route('permission.store') }}',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    Swal.fire('Permission Created Successfully')
                    location.reload();
                }
           });
      });
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('body').on('click', '#editPermission', function () {
        var permissionid = $(this).data('id');
        $.ajax({
            url: '/permission/edit/' + permissionid,
            type: 'GET',
            success: function (response) {
              $('#editPermissionModal').modal('show');
              $('#permissionid').val(response.id);
              $('#editPermissionName').val(response.name);
            }
        });
      });

      $(".EditPermission").click(function(e){
          e.preventDefault();
          var data = $('#editPermissionForm').serialize();
          $.ajax({
                type:'POST',
                url: '{{ route('permission.update') }}',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    Swal.fire('Permission Update Successfully')
                    location.reload();
                }
           });
      });
    });
</script>

@endsection
