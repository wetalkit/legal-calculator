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


    public static function getCategoryDetails($category) {
    	switch ($category) {
    		case self::FORMULA_LAWYER:
    			return [
    				'title' => 'lawyer',
    				'description' => 'Адвокат'
    			];
    			break;

    		case self::FORMULA_NOTAR:
    			return [
    				'title' => 'notar',
    				'description' => 'Нотар'
    			];
    			break;

    		case self::FORMULA_KATASTAR:
    			return [
    				'title' => 'katastar',
    				'description' => 'Катастар'
    			];
    			break;
    	}
    }

    public static function getFormulas()
    {
        return [
            self::FORMULA_LAWYER => 'Адвокат',
            self::FORMULA_NOTAR => 'Нотар',
            self::FORMULA_KATASTAR => 'Катастар',
        ];
    }
}
