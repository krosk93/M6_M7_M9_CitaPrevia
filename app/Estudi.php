<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudi extends Model
{
    protected $fillable = ['nom_estudi'];
    
    /*
     * Relació per a obtindre el dia de matriculació d'un estudi concret.
     * S'ha fet utilitzant hasOne i latest() per a poder tindre la possibilitat de que en
     * un futur un estudi pugui tindre varis dies de matriculació sense trencar la compatibilitat.
     */
    public function dia()
    {
        return $this->hasOne('App\Dia')->latest();
    }

    /*
     * EXTRA: Possibilitat futura de que un estudi pugui tindre varis dies de matriculació.
     */
    public function dies()
    {
        return $this->hasMany('App\Dia');
    }
}
