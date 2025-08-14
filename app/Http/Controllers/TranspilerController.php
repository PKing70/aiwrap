<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranspilerController extends Controller
{
    public function index()
    {
        return view('transpiler.index');
    }
}
