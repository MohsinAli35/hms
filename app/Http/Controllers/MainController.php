<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        
        $totalToday = $this->getDailyTotalPrice(); 
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
        return view('index', compact('patientCount','doctorsCount','employeesCount','totalToday'));
    }

   

    private function getDailyTotalPrice() // Method to calculate the daily total price
    {
        $today = Carbon::today(); // Get today's date

        // Calculate the total price for today
        $totalPrice = Patient::whereDate('created_at', $today)->sum('price');

        return $totalPrice;
    }
    // public function setting(){
    //     return view('setting.setting');
    // }
}
