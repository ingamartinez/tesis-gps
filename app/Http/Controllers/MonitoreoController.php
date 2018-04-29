<?php

namespace App\Http\Controllers;

use App\Arduino;
use App\Events\ActualizarArduinoEvent;
use App\Events\AlertaArduinoEvent;
use App\Mail\OrderShipped;
use App\Registro;
use App\Zona;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MonitoreoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('role:super-admin|user')->except('store');
        $this->middleware('auth')->except('store');
    }

    public function index()
    {
        $zonas = Zona::with('arduinos')->get();

        return view('usuario.monitoreo.index',compact('zonas'));
    }

    public function store(Request $request)
    {
        event(new ActualizarArduinoEvent(
            $request->luz,
            $request->temperatura,
            $request->sonido,
            $request->movimiento,

            $request->id
        ));

        $arduino = Arduino::withTrashed()->with('zona')->findOrFail($request->id);
        $now = new Carbon();
        $now->toTimeString();

        $registro = new Registro();
        $registro->luz = $request->luz;
        $registro->temperatura = $request->temperatura;
        $registro->sonido = $request->sonido;
        $registro->movimiento = $request->movimiento;
        $registro->mac = $request->id;
        $registro->zona = $arduino->zona->nombre;

        if(($now->toTimeString() > $arduino->zona->hora_fin) || ($now->toTimeString() < $arduino->zona->hora_inicio)){
            if ($request->luz >=20 || $request->sonido >= 40 || $request->temperatura <=25 || $request->movimiento == "SI"){

                Mail::to('ing.amartinez94@gmail.com')->send(new OrderShipped($arduino,$request));

                event(new AlertaArduinoEvent(
                    $arduino->zona->nombre,
                    'Alerta')
                );

                $registro->alert = true;
            }
        }
        $registro->save();
        return $request->all();
    }
}
