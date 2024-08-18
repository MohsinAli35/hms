<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        
        $employees = Employee::all();
        $employeesCount = 0;
        $doctorsCount = 0;
        foreach($employees as $employee){
            if ($employee->role->name == 'Doctors' || $employee->role->name == 'Doctor'  || $employee->role->name == 'doctors' || $employee->role->name == 'doctor') {
                $doctorsCount ++;
            }
            $employeesCount++;
        }
        
        $patientCount = Patient::count();
        return view('index', compact('patientCount','doctorsCount','employeesCount'));
    }
    public function setting(){
        return view('setting.setting');
    }
}
