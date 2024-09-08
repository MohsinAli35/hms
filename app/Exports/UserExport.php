<?php

namespace App\Exports;
use App\Models\Patient;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    private $patients;
    private $tokens;
    private $i;


    public function __construct($patients, $tokens)
    {
        $this->patients = $patients;
        $this->tokens = $tokens;
        $this->i = 0;
    }
    
    public function collection()
    {
        return $this->patients;
    }
    
    public function map($patient): array
    {
$myToken=0;
$this->i++;

        foreach ($this->tokens as $item) {

        
            if($item->paitent_id == $patient->id){
                $myToken=$item->token;
                // dd($myToken);

            }
            
    
        }
        // $tokenValue = $patient->token ? $patient->token->token : 'No Token';
        return [
            $this->i,
            $myToken,
            
            $patient->department->name,
            $patient->name,
            $patient->cnic,
            $patient->age,
            $patient->phone,
            $patient->gender == 1 ? 'Male' : ($patient->gender == 2 ? 'Female' : 'Transgender'),
            $patient->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'Serial #',
            'Token #',
            'Department',
            'Name',
            'CNIC',
            'Age',
            'Phone',
            'Gender',
            'Date of Visit',
        ];
    }

    public function __destructor(){
        Session::forget('filtered_patients');
    }
}

?>