<?php

namespace App\Exports;
use App\Models\Patient;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class dailyExport implements FromCollection, WithHeadings, WithMapping
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
            $patient->phone,
            $patient->price,
           
        ];
    }

    public function headings(): array
    {
        return [
            'Serial #',
            'Token #',
            'Department',
            ' Patient Name',
            'Phone',
            'Rate',
            'Address',
            
        ];
    }

    public function __destructor(){
        Session::forget('filtered_patients');
    }
}

?>