<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-index|role-create|role-show|role-edit|role-delete', ['only' => ['index']]);
         $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
         $this->middleware('permission:role-show', ['only' => ['show']]);
         $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(){
        $roles = Role::orderBy('id', 'DESC')->latest()->paginate(10);
        return view('admin.pages.roles.index', compact(
            'roles',
        ));
    }

    public function create(){
        $permission = Permission::get();
        return view('admin.pages.roles.create', compact(
            'permission',
        ));
    }

    public function store(Request $request){
        try{
            $request->validate([
                'name' => 'required|unique:roles,name',
                'permission' => 'required',
            ]);

            $array = [
                'name' => $request['name'],
            ];
    
            $role = Role::create($array);

            $role->syncPermissions($request['permission']);
    
            return redirect()->route('admin.roles.index')->with('success', 'Data has been created successfully at '.$role->created_at);
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id){
        $role = Role::find($id);
        $rolePermissions = Permission::join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->where('role_has_permissions.role_id', $id)
            ->get();
        return view('admin.pages.roles.show', compact(
            'role',
            'rolePermissions',
        ));
    }

    public function edit($id){
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.pages.roles.edit', compact(
            'role',
            'permissions',
            'rolePermissions',
        ));
    }

    public function update(Request $request, $id){
        try{
            $role = Role::find($id);

            $request->validate([
                'name' => 'required',
                'permission' => 'required',
            ]);
    
            $array = [
                'name' => $request['name'],
            ];

            $role->update($array);

            $role->syncPermissions($request['permission']);
    
            return redirect()->route('admin.roles.index')->with('success', 'Data has been edited successfully at '.$role->updated_at);
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id){
        try{
            $role = DB::table('roles')->where('id', $id)->delete();
    
            return redirect()->route('admin.roles.index')->with('error', 'Data has been deleted successfully at '.Carbon::now());
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }
}
