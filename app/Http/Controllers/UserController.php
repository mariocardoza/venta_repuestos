<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Storage;
use Illuminate\Support\Facades\Hash; 

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
        $roles = Role::whereIn('id',[2,3])->get();
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
        $roles = Role::whereIn('id',[2,3])->get();
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
          'name' => 'required|max:100',
          'phone' => 'nullable|max:100',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        if($user->email!= $request->email){
            $this->validate($request,['email'=> 'required|unique:users|email']);
        }
        if($user->username!= $request->username){
            $this->validate($request,['username'=> 'required|unique:users']);
        }
        if($request->filled('password')):
                $this->validate($request,['password'=> 'confirmed|min:7|string']);
            $user->password=Hash::make($request->password);
        endif;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->dui = $request->dui;
        $user->nit = $request->nit;
        $user->phone = $request->phone;
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

    public function getProfile(){
        return view('users.profile');
    }

    public function updateProfile(Request $request){
        $request->validate([
          'name' => 'required|max:100',
          'phone' => 'nullable|max:100',
          'avatar' => 'image|mimes:png,jpg|max:2048',
          //'username' => 'required|max:100',
          //'email' => 'required|max:192',
          //'password' => 'required|confirmed|string|min:7',
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        if($user->email!= $request->email){
            $this->validate($request,['email'=> 'required|unique:users|email']);
        }
        if($user->username!= $request->username){
            $this->validate($request,['username'=> 'required|unique:users']);
        }
        if($request->filled('password')):
                $this->validate($request,['password'=> 'confirmed|min:7|string']);
            $user->password=Hash::make($request->password);
        endif;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->dui = $request->dui;
        $user->nit = $request->nit;
        $user->phone = $request->phone;
        if(!is_null($request->avatar)){
            $user->avatar = url(Storage::url($this->uploadImage($request)));
        }
        $user->save();
        return redirect()->back()->with('success', 'Perfil modificado satisfactoriamente.');
    }

    private function uploadImage($request){
        $imageSize = getimagesize($request->avatar);
        $avatarExtension = image_type_to_extension($imageSize[2]);
        $filename = Storage::putFile('images/avatars', $request->avatar, 'public');
        return $filename;
    }

}
