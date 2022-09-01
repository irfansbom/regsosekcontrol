<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sls extends Model
{
    use HasFactory;
    protected $table = "sls";
    protected $guarded = [];

    function p_kabkot_k()
    {
        return $this->hasMany(P_Kabkot::class, 'id_sls', 'id_sls')->where('kues', 'K');
    }
    function p_kabkot_xk()
    {
        return $this->hasMany(P_Kabkot::class, 'id_sls', 'id_sls')->where('kues', 'VK');
    }
    function p_kabkot_vk()
    {
        return $this->hasMany(P_Kabkot::class, 'id_sls', 'id_sls')->where('kues', 'XK');
    }
    function p_provinsi()
    {
        return $this->hasMany(P_Prov::class, 'id_sls', 'id_sls');
    }
}
