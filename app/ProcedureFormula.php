<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedureFormula extends Model
{
    const FORMULA_LAWYER = 1;
    const FORMULA_NOTAR = 2;
    const FORMULA_KATASTAR = 3;
    
    protected $guarded = ['id'];
    protected $table = 'procedures_formulas';
    public $timestamps = true;
}
