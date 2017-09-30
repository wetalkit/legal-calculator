<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $table = "procedures";

    /**
     * Formulas
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formulas()
    {
        return $this->hasMany(ProcedureFormula::class);
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
