<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return User::where('id', '>', 1)->where('tipo', '=', 0)->get();
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function store(Request $request)
    {
        $user = new User();

        $user->name = ucwords(strtolower($request->name));
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        
        $user->save();

        return $user;
    }

    public function update(Request $request,  $id)
    {
        $user = User::where('id',$id)->first();

        $user->name = ucwords(strtolower($request->name));
        $user->email = $request->email;
        
        if ($request->password) {
            # code...
            $user->password = bcrypt($request->password);
        }
        
        $user->save();

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
    }

    public function setRoles(Request $request, User $user)
    {
        DB::table('role_user')->where('user_id','=',$user->id)->delete();

        DB::table('role_user')->insert([
            'role_id' => $request->rol,
            'user_id' => $user->id
        ]);
    }

    public function getRoles(User $user)
    {
        return @DB::table('role_user')->where('user_id','=',$user->id)->get()[0]->role_id;
    }

    public function permisoExiste($permiso)
    {
        return ['existe' => Auth::user()->can($permiso)];
    }
}
