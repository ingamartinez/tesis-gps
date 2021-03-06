<?php

namespace App\Http\Controllers;

use App\Rfid;
use App\User;
use HttpOz\Roles\Models\Role;
use Illuminate\Http\Request;

class AcudienteController extends Controller
{
    public function validar(Request $request){
        $request->validate([
            'acudiente' => 'bail|required',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed()->where('id','!=',5)->get();
        $roles = Role::all();
        $rfids = Rfid::all();
        return view('admin.gestion_acudientes.index', compact('users','roles','rfids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $user = User::withTrashed()->with('acudiente')->findOrFail($id);

//            dd($user->acudiente);

//            $rolID=[];
//            foreach ($user->roles as $rol){
//                $rolID=$rol->id;
//            }
//            $user->rol_id = $rolID;

//            dd($user);

            return response()->json($user,200);

        }catch (\Exception $ex){
            return response()->json(['message'=>'No se encuentra el usuario'],404);
//            return response()->json(['message'=>$ex],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::where('id',$id)->update(["users_id"=>$request->acudiente]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
