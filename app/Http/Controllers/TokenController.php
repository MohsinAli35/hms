<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Token;
use App\Models\Patient;
use App\Models\Department;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function generateToken($paitent_id,$p_name,$department){
        // $token = Token::generateToken($id,$name,$department);
        // return  $token;


        $depart = Department::find($department);
        $dept_token = Token::where('department_id',$department)
                      ->whereDate('created_at',Carbon::today()->toDateString())
                      ->latest()
                      ->first();
        if(!$dept_token){
           $dept_token= Token::create(
                [
                    'token'=>1,
                    'paitent_id'=>$paitent_id,
                    'paitent_name'=>$p_name,
                    'department_id'=>$department
                ]
                );
        }else{
            $token=$dept_token->token + 1;
            $dept_token= Token::create(
                [
                    'token'=>$token,
                    'paitent_id'=>$paitent_id,
                    'paitent_name'=>$p_name,
                    'department_id'=>$department
                ]
                );
        }
        return $dept_token->token;

    }
    public function addPatient(){
        $departments=Department::where('status',1)->get();
        return view('patient.add',compact('departments'));
    }
    public function storePatient(Request $request){
        $validated  = $request->validate(
            [
                'name'=>'required|max:700',
                'department_id'=>'required',
                'cnic'=>'max:20',
                'age'=>'required',
                'phone'=>'max:15',
                'gender'=>'required'
            ]
            );
        $new= Patient::create($validated);
        if($new){
            $patient = Patient::latest()->first();
            $token = $this->generateToken($patient->id,$patient->name,$patient->department_id);
            if($token){
                return redirect(route('patients.index'))
                ->with('success','Patient created successfull with token.');
            }
        }
            
    }
}
