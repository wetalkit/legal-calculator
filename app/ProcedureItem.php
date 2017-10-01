<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedureItem extends Model
{
    const ITEM_SELECT = 2;
    const ITEM_TEXT = 1;

    protected $table = 'procedure_items';

    protected $guarded = ['id'];
    protected $casts = [
        'options' => 'array'
    ];
    public $timestamps = true;
}
