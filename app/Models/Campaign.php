<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{

    protected $table = 'campaigns';
    protected $fillable = array(
        'titulo',
        'fechaFin',
        'cliente_id',
        'observacion',
        'tipoPublico',
        'tipoObjetivo',
        'tipoAudiencia',
        'interesPublico',
        'novedad',
        'actualidad',
        'autoridadCliente',
        'mediaticoCliente',
        'autoridadVoceros',
        'mediaticoVoceros',
        
    );
    protected $primaryKey = 'id';

  
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function getClienteAttribute()
    {
        return $this->cliente();
    }

    public function cliente(){
        return $this->belongsTo('App\Models\Clientes', 'cliente_id');
    }

    public function getPlanMediosAttribute()
    {
        return $this->planMedios();
    }

    public function planMedios(){
        return $this->hasMany('App\Models\PlanMedios', 'campaign_id')->with(['detallePlanMedios']);
    }

}
