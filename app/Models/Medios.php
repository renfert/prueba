<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medios extends Model
{

    protected $table = 'medios';
    
    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected $appends = ['medioPlataformas'];

    public function getMedioPlataformasAttribute()
    {
        return $this->medioPlataformas()->get();
    }

    public function medioPlataformas(){
       
        return $this->hasMany('App\Models\MedioPlataformas', 'medio_id')->with('plataformaClasificaciones');
    }

}
