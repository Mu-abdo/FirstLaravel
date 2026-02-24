<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Client;
use App\Models\Zebon;
use Illuminate\Http\Request;

class FatoraController extends Controller
{
    public function index(){
        $branchs = Branch::all();
        $companies = Company::all();
        $clients = Client::all();
        $zebons = Zebon::all();
        return view('fatora', compact('branchs', 'companies', 'clients', 'zebons'));
    }
}
