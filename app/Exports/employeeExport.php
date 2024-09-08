<?php

namespace App\Exports;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class employeeExport implements FromCollection, WithHeadings,WithMapping
{
    private $employees;
    private $i=0;

    public function __construct($employees)
    {
        // Ensure that $employees is a collection
        $this->employees = collect($employees);
    }

    public function collection()
    {
        // Return the employees collection
        return $this->employees;
    }

    public function map($employees): array
    {
        $this->i++;
        // Map the data structure to match the Excel columns
        return [
            $this->i, 
            $employees->name,
            $employees->dob,
            $employees->employee_id,
            $employees->role->name,
            $employees->cnic,
            $employees->d_i,
            $employees->d_e,
            $employees->blood,
            $employees->office_no,
            $employees->contact_no,
            $employees->account_no,

        ];
    }

    public function headings(): array
    {
        // Define the headings for the Excel file
        return [
            'Sr #',
            'Name',
            'DOB',
            'Employee ID',
            'Designation',
            'CNIC',
            'Issue Date',
            'Expiry Date',
            'Blood Group',
            'Office Phone',
            'Contact NO',
            'Account NO',
        ];
    }

    public function __destruct()
    {
        // Clear the session data when the object is destroyed
        Session::forget('filtered_employees');
    }
}



?>