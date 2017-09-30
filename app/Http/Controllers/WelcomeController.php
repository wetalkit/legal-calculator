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
}
