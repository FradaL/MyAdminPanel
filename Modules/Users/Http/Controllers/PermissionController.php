<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

use Alert;
use Modules\Users\Http\Requests\EditPermission;
use Modules\Users\Http\Requests\NewPermission;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::get();
        $permission = Permission::findOrFail(1);


        return view('users::permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('users::permission.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(NewPermission $request)
    {
        Permission::create($request->all());
        Alert::success('Se ha creado Correctamente');
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
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('users::permission.create', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param $id
     * @return Response
     */
    public function update($id, EditPermission $request)
    {
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->save();

        Alert::success('Se Editó Correctamente');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param id
     * @return Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        Alert::error('No se ha Podido Eliminar, Compruebe que no existan Roles con el permiso asignado')
            ->persistent('Cerrar');
        if($permission->roles()->count() == 0)
        {
            $permission->delete();
            Alert::Success( 'Se eliminó Correctamente');
        }
    }
}
