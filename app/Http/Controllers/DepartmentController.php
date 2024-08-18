<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::orderBy('id','DESC')->get();
        return view('departement.departement',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departement.add');
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
        $new = Department::create(
            [
                'name'=>$validated['name'],
                'discription'=>$validated['discription'],
                'status'=>$validated['status'],
            ]
            );
            if($new){
                return redirect(route('departments.index'))
                ->with('success','Departement created successfully');
            }else{
                return redirect()-back()
                ->with('danger','Something wrong. Please try again');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departement.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate(
            [
                'name'=>'required|max:250',
                'discription'=>'max:250',
                'status'=>'required'
                ]
            );
            $update = $department->update($validated);
            if($update){
                return redirect(route('departments.index'))
                ->with('success','Departement update successfully');
            }else{
                return redirect()-back()
                ->with('danger','Something wrong. Please try again');
            }
           

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $name = $department->name;
        $delete= $department->delete();
        if($delete){
            return redirect(route('departments.index'))
            ->with('success','Departement ' .$name. ' deleted successfully');
        }else{
            return redirect()->back()
            ->with('danger','Something wrong. Please try again');
        }
    }
}
