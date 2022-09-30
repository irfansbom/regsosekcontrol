<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    protected $table = "box";
    protected $guarded = [];


    function p_kabkot()
    {
        return $this->hasMany(P_Kabkot::class, 'no_box', 'id');
    }
}
