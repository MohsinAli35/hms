<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        if ($request->has('employee_id') || $request->has('name') || $request->has('role_id')) {
            $employees = Employee::when(
                $request->employee_id,
                function ($query, $employee_id) {
                    $query->where('employee_id', 'LIKE', '%' . $employee_id . '%');
                }
            )
                ->when(
                    $request->name,
                    function ($query, $name) {
                        $query->where('name', 'LIKE', '%' . $name . '%');
                    }
                )
                ->when(
                    $request->query('role_id'),
                    function ($query, $role_id) {
                        $role_name = Role::where('name', $role_id)->first()->id;
                        $query->where('role_id', 'LIKE', '%' . $role_name . '%');
                    }
                )->paginate(5);
        } else {
            $employees = Employee::paginate(5);
        }
        return view('employees.index', compact('employees', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('employees.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:70',
            'dob' => 'required|date',
            'employee_id' => 'required|unique:employees,employee_id|max:20',
            'role_id' => 'required|max:20',
            'cnic' => 'required|max:25',
            'd_i' => 'required|date',
            
            'blood' => 'required',


            'office_no' => 'required|max:35',
            'contact_no' => 'required|max:11',
            'address' => 'required|max:90',
            'account_no' => 'required|max:35',
            'image' => 'mimes:pdf|max:2048',

        ]);
        //  if($request->role == 1)
        //  {
        //     $emp= "Dor".$request->id;
        //  }
        //  elseif(){

        //  }

        //      if($request->hasfile('image')){

        // $pdfFile = $request->file('image');
        //  $request->image->storeAs('public/pdfs', $pdfFile->getClientOriginalName());

        //     //  $imageName = time().'.'.$request->image->extension();  
        //     //  $data = $request->all();

        //      $data['image'] = $pdfFile;
        //      Employee::create($data);
        //      dd($data);
        //      return to_route('employees.index');
        //     } 
        //      Employee::create($request->all());
        //           return to_route('employees.index');
        $image = '';
        
        if ($request->hasFile('image')) {
            $pdfFile = $request->file('image');
            // Store the PDF file in the 'public/pdfs' directory
            $pdfFileName = $pdfFile->getClientOriginalName();
            $pdfFile->storeAs('public/pdfs', $pdfFileName);

            // Add the PDF file name to the $data array
            $image= $pdfFileName;
        }

        // Create the employee record with all the data
        Employee::create(
            [
                'name' => $request->name,
            'dob' => $request->dob,
            'employee_id' => 'GAH-'.$request->employee_id,
            'role_id' => $request->role_id,
            'cnic' => $request->cnic,
            'd_i' => $request->d_i,
            'd_e' => '1888-01-01',
            'blood' => $request->blood,


            'office_no' => $request->office_no,
            'contact_no' => $request->contact_no,
            'address' => $request->address,
            'account_no' => $request->account_no,
            'image' => $image,
            ]
        );

        return to_route('employees.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $roles = Role::all();

        return view('employees.edit', compact('employee', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|max:70',
            'dob' => 'required|date',
            // 'employee_id' => 'required|unique:employees,employee_id|max:20',
            
            'role_id' => 'required|max:20',
            'cnic' => 'required|max:25',
            'd_i' => 'required|date',
            'd_e' => 'required|date',
            'blood' => 'required',
            'office_no' => 'required|max:35',
            'contact_no' => 'required|max:11',
            'address' => 'required|max:90',
            'account_no' => 'required|max:35',
            'image' => 'mimes:pdf|max:2048',
        ]);
        if ($request->hasfile('image')) {
            $pdfFile = $request->file('image');
            // $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();
            $pdfName =  $pdfFile->getClientOriginalName();
            $pdfFile->storeAs('public/pdfs', $pdfName);
            $validated['image'] = $pdfName;
        } else {
            // unset($validate['image']);
            // Update the employee's data

            $employee->update($validated);
            return to_route('employees.index');
        }
        $employee->update($validated);
        return to_route('employees.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return to_route('employees.index');
    }
}
