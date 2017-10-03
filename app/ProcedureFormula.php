<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedureFormula extends Model
{
    const FORMULA_LAWYER = 1;
    const FORMULA_NOTAR = 2;
    const FORMULA_KATASTAR = 3;
    const FORMULA_MVR = 4;
    const FORMULA_CRM = 5;
    const FORMULA_ZIS = 6;
    const FORMULA_UJP = 7;
    const FORMULA_SUD = 8;
    const FORMULA_REST = 9;

    protected $guarded = ['id'];
    protected $table = 'procedures_formulas';
    public $timestamps = true;

    public static function getCategoryDetails($category)
    {
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

            case self::FORMULA_MVR:
                return [
                    'title' => 'mvr',
                    'description' => 'МВР'
                ];
                break;

            case self::FORMULA_CRM:
                return [
                    'title' => 'crm',
                    'description' => 'Централен Регистар'
                ];
                break;

            case self::FORMULA_ZIS:
                return [
                    'title' => 'zis',
                    'description' => 'Завод за индустриска сопственост'
                ];
                break;

            case self::FORMULA_UJP:
                return [
                    'title' => 'ujp',
                    'description' => 'УЈП'
                ];
                break;

            case self::FORMULA_SUD:
                return [
                    'title' => 'sud',
                    'description' => 'Суд'
                ];
                break;

            case self::FORMULA_REST:
                return [
                    'title' => 'ostanato',
                    'description' => 'Останато'
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
            self::FORMULA_MVR => 'МВР',
            self::FORMULA_CRM => 'Централен Регистар',
            self::FORMULA_ZIS => 'Завод за индустриска сопственост',
            self::FORMULA_UJP => 'УЈП',
            self::FORMULA_SUD => 'Суд',
            self::FORMULA_REST => 'Останато'
        ];
    }
}
