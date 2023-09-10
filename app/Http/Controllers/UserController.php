<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $users = User::where('status', 1)->latest()->paginate(10);
        return view('admin.pages.users.index', compact(
            'users',
        ));
    }

    public function create(){
        $roles = Role::all();
        return view('admin.pages.users.create', compact(
            'roles',
        ));
    }

    public function store(Request $request){
        try{
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'roles' => 'required',
            ]);

            $array = [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ];
    
            $user = User::create($array);
            $user->assignRole($request['roles']);
    
            return redirect()->route('admin.users.index')->with('success', 'Data has been created successfully at '.$user->created_at);
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id){
        $user = User::find($id);
        return view('admin.pages.users.show', compact(
            'user',
        ));
    }

    public function edit($id){
        $user = User::find($id);
        $roles = Role::all();
        $userRole = $user->roles->all();
        return view('admin.pages.users.edit', compact(
            'user',
            'roles',
            'userRole',
        ));
    }

    public function update(Request $request, $id){
        try{
            $user = User::find($id);

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'roles' => 'required',
            ]);
    
            $array = [
                'name' => $request['name'],
                'email' => $request['email'],
            ];

            if($request['password']){
                $array['password'] = bcrypt($request['password']);
            }
    
            $user->update($array);
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request['roles']);
    
            return redirect()->route('admin.users.index')->with('success', 'Data has been edited successfully at '.$user->updated_at);
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id){
        try{
            $user = User::find($id);

            $user->update([
                'status' => 2,
            ]);
    
            return redirect()->route('admin.users.index')->with('error', 'Data has been deleted successfully at '.$user->updated_at);
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }
}
