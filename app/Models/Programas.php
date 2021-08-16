<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programas extends Model
{

    protected $table = 'programas';
    
    protected $primaryKey = 'id';

    protected $appends = ['medios'];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function getMediosAttribute()
    {
        return $this->medios();
    }

    public function medios(){
        return $this->belongsTo('App\Models\Medios', 'medio_id');
    }

    public function getProgramaContactosAttribute()
    {
        return $this->detallePlanMedios();
    }

    public function programaContactos(){
        return $this->hasMany('App\Models\ProgramaContactos', 'programa_id')->with(['medioPlataformas']);
    }
    
    

}
