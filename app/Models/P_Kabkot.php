<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class P_Kabkot extends Model
{
    use HasFactory;
    protected $table = "p_kabkot";
    protected $guarded = [];

    function box()
    {
        return $this->belongsTo(Box::class, 'no_box', 'id');
    }
}
