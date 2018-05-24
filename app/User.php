<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use HttpOz\Roles\Traits\HasRole;
use HttpOz\Roles\Contracts\HasRole as HasRoleContract;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements HasRoleContract
{
    use Notifiable,HasRole,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function getRolesByIdAttribute()
    {
        $collection = $this->roles()->each(function ($item, $key) {
            return $item->id;
        });

        return $this->roles();
    }

    public function rfid()
    {
        return $this->belongsTo('App\Rfid');
    }

    public function estduiante()
    {
        return $this->hasOne('App\User','users_id');
    }

    public function acudiente()
    {
        return $this->belongsTo('App\User','users_id');
    }

    public function rutas()
    {
        return $this->hasmany('App\Ruta','conductor_id');
    }

    public function hasRutaActiva(){
        $existe = \DB::table('rutas')->
            join('registro_rutas',"registro_rutas.rutas_id",'rutas.id')
            ->select('registro_rutas.estado')
            ->where('rutas.conductor_id','=',$this->id)
            ->where('registro_rutas.estado','=',1)
            ->exists();
        return $existe;
    }

    public function rutaActiva(){
        $nombre_ruta = \DB::table('rutas')->
        join('registro_rutas',"registro_rutas.rutas_id",'rutas.id')
            ->select('registro_rutas.id AS registro_rutas_id','rutas.nombre')
            ->where('rutas.conductor_id','=',$this->id)
            ->where('registro_rutas.estado','=',1)
            ->first();
        return $nombre_ruta;
    }

    public function estudianteEnRuta(){
        $existe = RegistroEstudiante::where('estudiante_id','=',$this->estduiante->id)->where('estado','=',1)->exists();

        return $existe;
    }

    public function rutaDelEstudiante(){
        $re=RegistroEstudiante::where('estudiante_id','=',$this->estduiante->id)->where('estado','=',1)->first();

        $rr=Ruta::findOrFail(RegistroRuta::findOrFail($re->registro_rutas_id)->rutas_id);


        return $rr;
    }


}
