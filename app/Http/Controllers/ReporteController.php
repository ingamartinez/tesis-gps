<?php

namespace App\Http\Controllers;

use App\Registro;
use App\Zona;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        $zonas = Zona::all();
        return view('usuario.reportes.index',compact('zonas'));
    }

    public function reporteZona(Request $request){
//        return response()->json(Carbon::parse(str_replace('/', '-', $request->inicio))->startOfDay());
        $db="";
        switch ($request->tipo_rango){
            case '5min':
                $db = Registro::where('zona','=',$request->zona)
                    ->whereBetween('created_at', [Carbon::parse(str_replace('/', '-', $request->inicio))->startOfDay(), Carbon::parse(str_replace('/', '-', $request->fin))->endOfDay()])
                    ->whereRaw('minute(created_at)%5 = 0')
                    ->get();

                $db = $db->reject(function ($item, $key) use ($db) {
                    try{
                        $fechaSiguiente = new Carbon($db[$key+1]->created_at);
                        $fechaSiguiente->minute;
                    }catch (\Exception $ex){
                        $fechaSiguiente = new Carbon($db[$key]->created_at);
                        $fechaSiguiente->minute;

                        return false;
                    }

                    $fechaActual = new Carbon($db[$key]->created_at);
                    $fechaActual->minute;

                    if($fechaActual->minute == $fechaSiguiente->minute){
                        return $item;
                    }

                });
            break;

            case '1h':
                $db = Registro::where('zona','=',$request->zona)
                    ->whereBetween('created_at', [Carbon::parse(str_replace('/', '-', $request->inicio))->startOfDay(), Carbon::parse(str_replace('/', '-', $request->fin))->endOfDay()])
                    ->whereRaw('hour(created_at)%1 = 0')
                    ->get();

                $db = $db->reject(function ($item, $key) use ($db) {
                    try{
                        $fechaSiguiente = new Carbon($db[$key+1]->created_at);
                        $fechaSiguiente->hour;
                    }catch (\Exception $ex){
                        $fechaSiguiente = new Carbon($db[$key]->created_at);
                        $fechaSiguiente->hour;

                        return false;
                    }

                    $fechaActual = new Carbon($db[$key]->created_at);
                    $fechaActual->hour;

                    if($fechaActual->hour == $fechaSiguiente->hour){
                        return $item;
                    }

                });
            break;
            case '5h':
                $db = Registro::where('zona','=',$request->zona)
                    ->whereBetween('created_at', [Carbon::parse(str_replace('/', '-', $request->inicio))->startOfDay(), Carbon::parse(str_replace('/', '-', $request->fin))->endOfDay()])
                    ->whereRaw('hour(created_at)%5 = 0')
                    ->get();

                $db = $db->reject(function ($item, $key) use ($db) {
                    try{
                        $fechaSiguiente = new Carbon($db[$key+1]->created_at);
                        $fechaSiguiente->hour;
                    }catch (\Exception $ex){
                        $fechaSiguiente = new Carbon($db[$key]->created_at);
                        $fechaSiguiente->hour;

                        return false;
                    }

                    $fechaActual = new Carbon($db[$key]->created_at);
                    $fechaActual->hour;

                    if($fechaActual->hour == $fechaSiguiente->hour){
                        return $item;
                    }

                });
            break;
        }

        return response()->json($db);
    }

}
