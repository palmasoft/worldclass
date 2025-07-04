<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\DB;
use Caffeinated\Shinobi\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return Role::where('id','>',4)->get();
    }

    public function store(Request $request)
    {
        $role = new Role();

        $role->name = $request->name;
        $role->slug = str_replace(' ','.',$request->name);
        $role->description = $request->description;

        $role->save();

        return $role;
    }

    public function update(Request $request, Role $role)
    {
        $role->name = $request->name;
        $role->slug = str_replace(' ','.',$request->name);
        $role->description = $request->description;

        $role->save();

        return $role;
    }

    public function destroy(Role $role)
    {
        $role->delete();
    }

    public function setPermisos(Request $request, Role $role)
    {
        DB::table('permission_role')->where('role_id','=',$role->id)->delete();

        if ($request->permisos) {
            foreach ($request->permisos as $permiso) {
                DB::table('permission_role')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permiso
                ]);
            }
        }

        return $request->permisos;
    }

    public function getPermisos(Role $role)
    {
        $permisos = [];

        $permisosD = DB::table('permission_role')->where('role_id','=',$role->id)->get();

        foreach ($permisosD as $permiso) {
            array_push($permisos,$permiso->permission_id);
        }

        return $permisos;
    }

    public function permisos()
    {
        return Permission::get();
    }
}
