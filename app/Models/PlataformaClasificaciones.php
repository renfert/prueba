<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlataformaClasificaciones extends Model
{

    protected $table = 'plataforma_clasificacions';
    
    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected $appends = ['plataforma'];

    public function getMedioPlataformasAttribute()
    {
        return $this->medioPlataformas()->get();
    }

    public function medioPlataformas(){
       
        return $this->hasMany('App\Models\MedioPlataformas', 'medio_id');
    }

    public function getPlataformaAttribute()
    {
        return $this->plataformaClasificacion();
    }

    public function plataforma(){
        
        return $this->belongsTo('App\Models\Plataforma', 'plataforma_id');
    }

    public function plataformaClasificacion(){
        return $this->plataforma();

    }

    

}
