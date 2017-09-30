<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $table = "procedures";

    public function formulas()
    {
        return $this->hasOne(ProcedureFormula::class);
    }

    public function items()
    {
        return $this->hasOne(ProcedureItem::class);
    }
}
