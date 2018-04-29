<?php

namespace App\Http\Controllers;

use App\Arduino;
use App\User;
use App\Zona;
use Illuminate\Http\Request;
use DB;
use Flash;

class ArduinoController extends Controller
{
    /**
     * Validate request.
     *
     */

    public function validar(Request $request){
        $request->validate([
            'id_arduino' => 'bail|required|unique:arduinos,mac,'.$request->id.'|max:191',
            'zona' => 'bail|required',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arduinos = Arduino::withTrashed()->get();
        $zonas = Zona::all();
        return view('admin.gestion_arduinos.index', compact('arduinos','zonas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'id_arduino' => 'bail|required|unique:arduinos,mac|max:191',
            'zona' => 'bail|required',
        ]);

//        dd($request->all());

        try{
            DB::beginTransaction();

            $arduino = new Arduino();
            $arduino->mac = $request->id_arduino;
            $arduino->zonas_id= $request->zona;

            $arduino->save();

//            throw new \Exception('No se pudo registrar el Arduino');

            Flash::success('Arduino creado correctamente');

            DB::commit();

            return redirect()->back();
        }catch (\Exception $ex){
            DB::rollBack();

            Flash::error('Error al registrar Arduino - '.$ex->getMessage());

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
        try{
            $arduino = Arduino::withTrashed()->with('zona')->findOrFail($id);

//            dd(json_encode($arduino));
//
            return response()->json($arduino,200);

        }catch (\Exception $ex){
            return response()->json(['message'=>'No se encuentra el Arduino'],404);
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
        $arduino = Arduino::withTrashed()->findOrFail($id);

        try{
            DB::beginTransaction();

            $arduino->mac = $request->id_arduino;
            $arduino->zonas_id = $request->zona;
            $arduino->save();

            DB::commit();

            Flash::success('Arduino editado correctamente');

            return response()->json($arduino,200);

        }catch (\Exception $ex){
            DB::rollBack();

            Flash::error('Error al editar arduino - '.$ex->getMessage());

            return response()->json(['message'=>'Error al editar arduino'.$ex->getMessage()],404);
        }
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

            Arduino::destroy($id);

            DB::commit();

            Flash::success('Arduino eliminado correctamente');

            return response()->json('Arduino eliminado correctamente',200);

        }catch (\Exception $ex){
            DB::rollBack();

            //Flash::error('Error al editar - '.$ex->getMessage());

            return response()->json('No se puede eliminar el arduino',404);
        }
    }
    public function restore($id)
    {
        try{
            DB::beginTransaction();

            //throw new \Exception('No se pudo crear el usuario');

            Arduino::withTrashed()->findOrFail($id)->restore();

            DB::commit();

            Flash::success('Arduino restaurado correctamente');

            return response()->json('Arduino restaurado correctamente',200);

        }catch (\Exception $ex){
            DB::rollBack();

            //Flash::error('Error al editar - '.$ex->getMessage());

            return response()->json('No se pudo restaurar el arduino'.$ex->getMessage(),404);
        }


    }
}
