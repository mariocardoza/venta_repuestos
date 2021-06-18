<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
{

    public function index(Request $request){
        if ($request->has('keyword')){
          $users = User::where('fullname', 'LIKE', "%{$request->keyword}%")
            ->orWhere('email', 'LIKE', "%{$request->keyword}%")
            ->whereIn('role_id',[2,3])
            ->get();
        } else {
          $users = User::whereIn('role_id',[2,3])->get();
        }
        return view('users.index', compact('users'));
    }

    public function create(Request $reques)
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required|max:100',
          'role_id' => 'required|max:100',
          'username' => 'required|max:100|unique',
          //'birthday' => 'required|max:100',
          'email' => 'required|unique:users|max:192',
          'password' => 'required|confirmed|string|min:8',

        ]);

        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->username=$request->username;
        $user->role_id = $request->role_id;
        $user->password=Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario creado satisfactoriamente.');
    }

    public function edit($id)
    {
        $user=User::find($id);
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));

    }

    public function profile($id)
    {
        $user=User::find($id);
        return view('users.profile',compact('user'));

    }


    public function update(Request $request,$id)
    {
        $request->validate([
          'fullname' => 'required|max:100',
          'profession' => 'required|max:100',
          'role_id' => 'required|max:100',
          'phone' => 'required|max:100',
          //'birthday' => 'required|max:100',
        ]);
        $user=User::find($id);
        $user->fullname=$request->fullname;
        $user->phone=$request->phone;
        $user->profession=$request->profession;
        $user->birthday= $request->birthday !=null ? $request->birthday : '1990-01-01';
        $user->role_id=$request->role_id;
        if($request->filled('password')):
                $this->validate($request,['password'=> 'confirmed|min:7|string']);
            $user->password=Hash::make($request->password);
        endif;
        if($user->email!= $request->email){
            $this->validate($request,['email'=> 'required|unique:users|email']);
        }
        $user->email=$request->email;
        $user->save();
        return redirect()->route('users.index')->with('success', 'Usuario actualizado satisfactoriamente.');
    }

    public function destroy($id)
    {
        $user=User::find($id);
        if($user->role_id==1):
            return redirect()->back()->with('success', 'No se puede eliminar el usuario super administrador.');
        else:
            $user->delete();
        endif;
        return redirect()->back()->with('success', 'Usuario eliminado satisfactoriamente.');
    }

}
