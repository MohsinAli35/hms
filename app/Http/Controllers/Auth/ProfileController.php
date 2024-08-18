<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        return view('profile.profile', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate(
            [
                'f_name' => 'required|max:30',
                'l_name' => 'required|max:30',
                'username' => 'required|max:50',
                'email' => 'required|max:75',
                'phone' => 'required|max:15',
            ]
        );
        if($request->has('image')){
            $image =$request->file('image');
            $imagePath=$image->store('profiles','public');
            $validated['image']=$imagePath;
            if($user->image !== null){
                Storage::disk('public')->delete($user->image);
            }
        }
        if($request->input('password') != ''){
            $request->validate(
                [
                    'password' => 'max:16|min:8'
                ]
            );
            $validated['password']=Hash::make($request->password);
        }
        
        $update = $user->update($validated);
        if ($update) {
            return to_route('myprofile', $user->id)->with('success', "Your profile is updated.");
        } else {
            return redirect()->back()->with('danger', 'Something wrong please try again');
        }
    }
}
