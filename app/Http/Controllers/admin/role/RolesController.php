<?php

namespace App\Http\Controllers\admin\role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
  public function index()
  {
    $permission = Permission::get();
    $role = Role::get();
    return view('roles.roles', compact('permission', 'role'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'modalRoleName' => 'required|unique:roles,name',
      'permission' => 'required',
    ]);
    $role = Role::create(['name' => $request->modalRoleName]);
    $role->syncPermissions($request->permission);

    return response()->json(['success' => 'Role created successfully.']);
  }

  public function edit($id)
  {
    $role = Role::find($id);
    $rolepermission = DB::table('role_has_permissions')
      ->where('role_id', $role->id)
      ->get();
    $permission = [];
    if (!empty($rolepermission)) {
      foreach ($rolepermission as $value) {
        $permission[] = $value->permission_id;
      }
    }
    $data['role'] = $role;
    $data['permission'] = $permission;
    return response()->json($data);
  }

  public function update(Request $request)
  {
    $roleid = $request->roleid;
    $modalRoleName = $request->modalRoleName;
    $permission = $request->permission;
    $role = Role::where('id', $roleid)->update(['name' => $modalRoleName]);
    $deleted = DB::table('role_has_permissions')
      ->where('role_id', $roleid)
      ->delete();
    foreach ($permission as $value) {
      DB::table('role_has_permissions')->insert([
        'permission_id' => $value,
        'role_id' => $roleid,
      ]);
    }

    return response()->json(['success' => 'Role update successfully.']);
  }
}
