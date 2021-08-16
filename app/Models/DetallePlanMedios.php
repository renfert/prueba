<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePlanMedios extends Model
{

    protected $table = 'detalle_plan_medios';
    
    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    
    protected $fillable = array(
        'statusPublicado'
    );

    protected $appends = ['programaContactos'];

    public function getProgramaContactosAttribute()
    {
        return $this->programaContactos();
    }

    public function programaContactos(){
        return $this->belongsTo('App\Models\ProgramaContactos', 'idProgramaContacto')->with('programas');
    }
}
