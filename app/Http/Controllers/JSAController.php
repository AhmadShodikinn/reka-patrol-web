<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class JSAController extends Controller
{
    public function index()
    {
        //model e rung di create ya jsa
        
        return Inertia::render('JSA/Index', [
            'jsas' => [], // Fetch your JSA data here
        ]);
    }
    
}
