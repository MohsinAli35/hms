<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $roles = Role::orderBy('id','DESC')->get();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name'=>'required|max:250',
                'discription'=>'max:250',
                'status'=>'required'
            ]
            );
        $new = Role::create(
            [
                'name'=>$validated['name'],
                'discription'=>$validated['discription'],
                'status'=>$validated['status'],
            ]
            );
            if($new){
                return redirect(route('roles.index'))
                ->with('success','Role created successfully');
            }else{
                return redirect()->back()
                ->with('danger','Something wrong. Please try again');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('roles.edit',compact('role'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(
            [
                'name'=>'required|max:250',
                'discription'=>'max:250',
                'status'=>'required'
                ]
            );
            $update = $role->update($validated);
            if($update){
                return redirect(route('roles.index'))
                ->with('success','Role update successfully');
            }else{
                return redirect()->back()->with('danger','Something wrong. Please try again');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $name = $role->name;
        $delete= $role->delete();
        if($delete){
            return redirect(route('roles.index'))
            ->with('success','Role ' .$name. ' deleted successfully');
        }else{
            return redirect()->back()
            ->with('danger','Something wrong. Please try again');
        }
    }
}
