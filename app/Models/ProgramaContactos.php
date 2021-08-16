<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramaContactos extends Model
{

    protected $table = 'programa_contactos';
    
    protected $primaryKey = 'id';

    protected $appends = ['programas'];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    
    public function getProgramasAttribute()
    {
        return $this->programas();
    }

    public function programas(){
        return $this->belongsTo('App\Models\Programas', 'programa_id')->with('medios');
    }

}
