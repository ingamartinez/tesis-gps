<?php

namespace App\Http\Controllers;

use App\RegistroEstudiante;
use App\RegistroRuta;
use App\Ruta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class RutaConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rutas = Ruta::where('conductor_id','=',auth()->user()->id)->get();
        return view('conductor.ruta.index',compact('rutas'));
    }

    public function estudiantesEnRuta()
    {
        $rutas = Ruta::where('conductor_id','=',auth()->user()->id)->get();

        $estudiantes = DB::table('rutas')
            ->join('registro_rutas',"registro_rutas.rutas_id",'rutas.id')
            ->join('registro_estudiantes AS re',"re.registro_rutas_id",'registro_rutas.id')
            ->join('users',"re.estudiante_id",'users.id')
            ->select('rutas.nombre AS ruta','users.id AS users_id','users.name AS users_name','re.estado AS estado_ruta')
            ->where('rutas.conductor_id','=',auth()->user()->id)
            ->where('registro_rutas.estado','=',1)
        ->get();


        return response()->json($estudiantes,200);
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
        $registroRuta = new RegistroRuta();

        $registroRuta->rutas_id= $id;
        $registroRuta->lugar_inicio=null;
        $registroRuta->fecha_inicio=Carbon::now();
        $registroRuta->estado=1;

        $registroRuta->save();

        return response()->json(['message'=>'Ruta iniciada'],200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finalizarRuta(Request $request, $id)
    {
        $estudiantes = DB::table('rutas')
            ->join('registro_rutas',"registro_rutas.rutas_id",'rutas.id')
            ->join('registro_estudiantes AS re',"re.registro_rutas_id",'registro_rutas.id')
            ->join('users',"re.estudiante_id",'users.id')
            ->select('rutas.nombre AS ruta','users.id AS users_id','users.name AS users_name','re.estado AS estado_ruta')
            ->where('rutas.conductor_id','=',auth()->user()->id)
            ->where('registro_rutas.estado','=',1)
            ->where('re.estado','=',1)
        ->get();

        //dd($estudiantes);

        if($estudiantes->isEmpty()){
            $registroRuta = RegistroRuta::findOrFail($id);

            $registroRuta->estado=0;

            $registroRuta->save();

            return response()->json(['message'=>'Ruta Finalizada'],200);
        }else{
            return response()->json(['message'=>'Aún hay estudiantes'],404);
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
        //
    }
}
