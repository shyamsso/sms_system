<?php

namespace App\Http\Controllers\admin\permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
  public function index()
  {
    return view('permission.permission');
  }

  public function getallPermission(Request $request)
  {
    $permissionList = Permission::get();
    return response()->json(['data' => $permissionList]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'modalPermissionName' => 'required',
    ]);

    $permission = Permission::create(['name' => $request->modalPermissionName]);

    return response()->json(['success' => 'Permission created successfully.']);
  }
  public function delete($id)
  {
    Permission::find($id)->delete($id);

    return response()->json([
      'success' => 'Record deleted successfully!',
    ]);
  }
  public function edit($id)
  {
    $permission = Permission::find($id);
    return response()->json($permission);
  }
  public function update(Request $request)
  {
    $permissionid = $request->permissionid;
    $editPermissionName = $request->editPermissionName;
    Permission::where('id', $permissionid)->update(['name' => $editPermissionName]);

    return response()->json(['success' => 'Permission update successfully.']);
  }
}
