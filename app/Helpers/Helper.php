<?php 

namespace App\Helpers;

class Helper
{
    /**
     * [valRange description]
     * 
     * @param  [type]  $val     [description]
     * @param  [type]  $range   [description]
     * @param  integer $default [description]
     * 
     * @return [type]           [description]
     */
    public function valRange($val, $range, $default = 0)
    {
        foreach ($range as $key => $value) {
            if ($key >= $val) {
                return $value;
            }
        }
        return $default;
    }

    /**
     * [valRangeInv description]
     * 
     * @param  [type]  $val     [description]
     * @param  [type]  $range   [description]
     * @param  integer $default [description]
     * 
     * @return [type]           [description]
     */
    public function valRangeInv($val, $range, $default = 0)
    {
        foreach ($range as $key => $value) {
            if ($key < $val) {
                return $value;
            }
        }
        return $default;
    }

    /**
     * Format money.
     * 
     * @return string
     */
    public static function money($amount, $decimalPlaces = 2)
    {
        $amount = number_format($amount, $decimalPlaces, ',', '.');

        return $amount.' ден.';
    }
}
