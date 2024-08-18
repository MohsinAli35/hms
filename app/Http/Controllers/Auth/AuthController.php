<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        if(auth()->id() != null){
            return redirect()->back();
        }
        return view('login');
    }
    public function check(Request $request){
        // dd(Hash::make(12345678));
        $validated = $request->validate(
            [
                'email'=>'required|max:130',
                'password'=>'max:16|min:8',
            ]
            );
        $validated['status']=1;
        if(auth()->attempt($validated)){
            $request->session()->regenerate();
            return redirect(route('home'));
        }
        else{
            return redirect(route('login'))->with('danger','Sorry I could Not Found You.');
        }
        
    }
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
    public function profile(){
        
    }
}
