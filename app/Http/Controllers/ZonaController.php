<?php

namespace App\Http\Controllers;

use App\User;
use App\Zona;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Flash;


class ZonaController extends Controller
{
    /**
     * Validate request.
     *
     */

    public function validar(Request $request){
        $request->validate([
            'nombre' => 'bail|required|max:191',
            'descripcion' => 'bail|max:191',
            'hora_inicio' => 'bail|required|max:191',
            'hora_fin' => 'bail|required',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zonas = Zona::withTrashed()->get();
        return view('admin.gestion_zonas.index', compact('zonas'));
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
            'nombre' => 'bail|required|max:191',
            'descripcion' => 'bail|max:191',
            'hora_inicio' => 'bail|required|max:191',
            'hora_fin' => 'bail|required',
        ]);

//        dd($request->all());

        try{
            DB::beginTransaction();

            $hora_inicio = new Carbon($request->hora_inicio);
            $hora_fin= new Carbon($request->hora_fin);

            $zona = new Zona();
            $zona->nombre = $request->nombre;
            $zona->descripcion = $request->descripcion;
            $zona->hora_inicio = $hora_inicio->toTimeString();
            $zona->hora_fin = $hora_fin->toTimeString();

            $zona->save();

//            throw new \Exception('No se pudo registrar el Arduino');

            Flash::success('Zona creada correctamente');

            DB::commit();

            return redirect()->back();
        }catch (\Exception $ex){
            DB::rollBack();

            Flash::error('Error al registrar Zona - '.$ex->getMessage());

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
            $zona = Zona::withTrashed()->findOrFail($id);
            $zona->hora_inicio = Carbon::parse($zona->hora_inicio)->format('g:i A');
            $zona->hora_fin = Carbon::parse($zona->hora_fin)->format('g:i A');

//            dd(json_encode($arduino));
//
            return response()->json($zona,200);

        }catch (\Exception $ex){
            return response()->json(['message'=>'No se encuentra la zona'],404);
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
        $zona = Zona::withTrashed()->findOrFail($id);

        try{
            DB::beginTransaction();

            $hora_inicio = new Carbon($request->hora_inicio);
            $hora_fin= new Carbon($request->hora_fin);

            $zona->nombre = $request->nombre;
            $zona->descripcion = $request->descripcion;
            $zona->hora_inicio = $hora_inicio->toTimeString();
            $zona->hora_fin = $hora_fin->toTimeString();

            $zona->save();

            DB::commit();

            Flash::success('Zona editada correctamente');

            return response()->json($zona,200);

        }catch (\Exception $ex){
            DB::rollBack();

            Flash::error('Error al editar Zona - '.$ex->getMessage());

            return response()->json(['message'=>'Error al editar Zona'.$ex->getMessage()],404);
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

            Zona::destroy($id);

            DB::commit();

            Flash::success('Zona eliminada correctamente');

            return response()->json('Zona eliminada correctamente',200);

        }catch (\Exception $ex){
            DB::rollBack();

            //Flash::error('Error al editar - '.$ex->getMessage());

            return response()->json('No se puede eliminar la Zona',404);
        }
    }

    public function restore($id)
    {
        try{
            DB::beginTransaction();

            //throw new \Exception('No se pudo crear el usuario');

            Zona::withTrashed()->findOrFail($id)->restore();

            DB::commit();

            Flash::success('Zona restaurada correctamente');

            return response()->json('Zona Restaurada correctamente',200);

        }catch (\Exception $ex){
            DB::rollBack();

            //Flash::error('Error al editar - '.$ex->getMessage());

            return response()->json('No se pudo restaurar la Zona',404);
        }


    }
}
