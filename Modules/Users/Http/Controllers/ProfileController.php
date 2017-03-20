<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Users\Entities\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = User::FindOrFail(Auth::user()->id);

        return view('users::users.profile', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */

    public function store(Request $request)
    {
        $user = User::FindOrFail(Auth::user()->id);

        $user->username = $user->username;
        $user->name = $request->name;
        $user->email = $request->email;
            if($request->has('password'))
            {
                $user->password = bcrypt($request->password);
                $user->save();
                Auth::logout();
                return redirect("/")
                    ->with('Message', 'Se ha editado el perfil con éxito, 
                            por su seguridad ingrese con el nuevo password');
            }
        $user->save();

        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('users::create');
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
     * @return Response
     */
    public function edit()
    {
        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
