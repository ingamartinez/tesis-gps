<?php

namespace App\Http\Controllers;

use App\Rfid;
use Illuminate\Http\Request;
use DB;

class RfidController extends Controller
{
    public function validar(Request $request){
        $request->validate([
            'rfid' => 'bail|required|max:191|unique:rfid,serial',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rfids= Rfid::withTrashed()->get();
        return view('admin.gestion_rfid.index',compact('rfids'));
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
        $request->validate([
            'rfid' => 'bail|required|max:191|unique:rfid,serial',
        ]);

        try{
            DB::beginTransaction();

            $rfid = new Rfid();
            $rfid->serial = $request->rfid;

            $rfid->save();

//            throw new \Exception('No se pudo registrar el Arduino');

            \Flash::success('Tag registrado Correctamente');

            DB::commit();

            return redirect()->back();
        }catch (\Exception $ex){
            DB::rollBack();

            \Flash::error('Error al registrar Tag - '.$ex->getMessage());

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::beginTransaction();

            //throw new \Exception('No se pudo crear el usuario');

            Rfid::destroy($id);

            DB::commit();

            \Flash::success('Rfid  eliminado corectamente');

            return response()->json('Rfid  eliminado corecctamente',200);

        }catch (\Exception $ex){
            DB::rollBack();

            //Flash::error('Error al editar - '.$ex->getMessage());

            return response()->json('No se puede eliminar el Rfid',404);
        }
    }

    public function restore($id)
    {
        try{
            DB::beginTransaction();

            //throw new \Exception('No se pudo crear el usuario');

            Rfid::withTrashed()->findOrFail($id)->restore();

            DB::commit();

            \Flash::success('Zona restaurada correctamente');

            return response()->json('Rfid Restaurado correctamente',200);

        }catch (\Exception $ex){
            DB::rollBack();

            //Flash::error('Error al editar - '.$ex->getMessage());

            return response()->json('No se pudo restaurar el Rfid',404);
        }


    }
}
