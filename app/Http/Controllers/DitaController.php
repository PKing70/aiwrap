<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DitaController extends Controller
{
    public function index()
    {
        return view('dita.index');
    }
} 