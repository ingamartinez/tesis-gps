<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroEstudiante extends Model
{
    protected $table = "registro_estudiantes";

    public function toggleState()
    {
        $this->estado= !$this->estado;
        return $this;
    }
}
