<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanMedios extends Model
{

    protected $table = 'plan_medios';
    
    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected $appends = ['detallePlanMedios'];

    public function getCampaignAttribute()
    {
        return $this->cliente();
    }

    public function campaign(){
        return $this->belongsTo('App\Models\Campaign', 'campaign_id');
    }

    public function getDetallePlanMediosAttribute()
    {
        return $this->detallePlanMedios();
    }

    public function detallePlanMedios(){
        return $this->hasMany('App\Models\DetallePlanMedios', 'idPlanMedio')->with(['programaContactos']);
    }

}
