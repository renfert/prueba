<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plataforma extends Model
{

    protected $table = 'plataforma';
    
    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];


}
