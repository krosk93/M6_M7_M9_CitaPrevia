<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = ['hora', 'estat', 'dia_id'];
    
    /*
     * Una cita sempre pertany a un dia determinat.
     */
    public function dia()
    {
        return $this->belongsTo('App\Dia');
    }

    public function scopeBuides($query)
    {
        return $query->where('estat', 'buit');
    }

    public function scopeAmbEstat($query, $param)
    {
        return $query->where('estat', $param);
    }
}
