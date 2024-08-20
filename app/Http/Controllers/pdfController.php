<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Department;
use App\Models\Token;
use Illuminate\Http\Request;

class pdfController extends Controller
{
    public function index(){
        // $departments = 
        // return view('reports.index');
        $patients = Patient::orderBy('id', 'DESC');
        $departments = Department::where('status', 1)->get();
        $tokens = Token::all();
        
        return view('reports.index', compact('patients', 'tokens', 'departments'));
  
    }
}
