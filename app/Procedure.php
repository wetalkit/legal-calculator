<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $table = "procedures";

    /**
     * Formuls
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function formulas()
    {
        return $this->hasOne(ProcedureFormula::class);
    }

    /**
     * Items
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(ProcedureItem::class);
    }
}
