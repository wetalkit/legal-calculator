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

    public function about()
    {
        $bodyClass = 'static';
        return view('about', compact('bodyClass'));
    }

    public function reportBug()
    {
        $bodyClass = 'static';
        return view('report_bug', compact('bodyClass'));        
    }
}
