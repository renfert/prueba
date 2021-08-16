<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedioPlataformas extends Model
{

    protected $table = 'medio_plataformas';
    
    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $appends = ['plataformaClasificaciones'];
    

    public function medios(){
        return $this->belongsTo('App\Models\Medios', 'medio_id');
    }

    public function getPlataformaClasificacionesAttribute()
    {
     
        return $this->plataformaClasificaciones();
    }


    public function plataformaClasificaciones(){
        return $this->belongsTo('App\Models\PlataformaClasificaciones', 'idPlataformaClasificacion');
    }

}
