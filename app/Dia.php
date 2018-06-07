<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    protected $fillable = ['dia', 'estudi_id'];
    /*
     * El dia pertany només a un estudi, per tant creem una relació belongsTo.
     */
    public function estudi()
    {
        return $this->belongsTo('App\Estudi');
    }

    /*
     * Relació per a accedir a les cites de cert dia. Un dia té varies cites (hasMany)
     */
    public function cites()
    {
        return $this->hasMany('App\Cita');
    }
}
