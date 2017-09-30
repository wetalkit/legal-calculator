<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Procedure;

class WelcomeController extends Controller
{
    public function index()
    {
        $procedures = Procedure::all()->pluck('name', 'id');
        return view('welcome', compact('procedures'));
    }

    public function getItemsByProcedure(Request $request)
    {
        $items = Procedure::find($request->procedureId)->items;
        return $items;
    }

    public function calculate()
    {
        return 
        '{
            "costs": [
                {
                    "title": "lawyer", 
                    "description": "Адвокат",
                    "costs": [
                        {"title": "Договор", "cost": 3400}
                    ]
                },
                {
                    "title": "notary", 
                    "description": "Нотар",
                    "costs": [
                        { "title": "Солемнизација", "cost": 3300 },
                        { "title": "Заверка", "cost": 5300 }
                    ]
                }
            ],
            "total": 12000
        }';
    }
}
