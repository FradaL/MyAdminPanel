<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Users\Entities\Permission;
use Modules\Users\Http\Requests\EditRole;
use Modules\Users\Http\Requests\NewRole;
use Spatie\Permission\Models\Role;
use Alert;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $roles = Role::get();
        return view('users::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::pluck('name', 'name');
        return view('users::roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(NewRole $request)
    {
       $role = Role::create([ 'name' => $request->name]);

       $role->givePermissionTo($request->permission);
       Alert::success("Se Creo Correctamente");
       return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return Response recive ID in method edit
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $data = $role->permissions->pluck('name')->toArray();

        $permissions = Permission::pluck('name','name');
        return view('users::roles.create', compact('role', 'data', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     * @param id
     * @param  EditRole $request
     * @return Response
     */
    public function update($id, EditRole $request)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        $role->revokePermissionTo(Permission::all());
        $role->givePermissionTo($request->permission);
        Alert::success("Se actualizó correctamente");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param id
     * @return Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        Alert::error('No se ha Podido Eliminar, Compruebe que no existan usuarios con el role asignado')
            ->persistent('Cerrar');
        if($role->users()->count() == 0 )
        {
            $role->delete();
            Alert::success("Se eliminó Correctamente");
        }



    }
}
