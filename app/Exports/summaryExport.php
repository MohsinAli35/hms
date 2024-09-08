<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Session;

class SummaryExport implements FromCollection, WithHeadings, WithMapping
{
    private $summary;

    public function __construct($summary)
    {
        // Ensure that $summary is a collection
        $this->summary = collect($summary);
    }

    public function collection()
    {
        // Return the summary collection
        return $this->summary;
    }

    public function map($summary): array
    {
        // Map the data structure to match the Excel columns
        return [
            $summary['department_name'],  // Department Name
            $summary['total_tokens'],     // Total Tokens
            // $summary['total_price'],      // Total Price
            number_format($summary['total_price'], 2),
        ];
    }

    public function headings(): array
    {
        // Define the headings for the Excel file
        return [
            'Department',
            'Tokens',
            'Rates',
        ];
    }

    public function __destruct()
    {
        // Clear the session data when the object is destroyed
        Session::forget('filtered_summary');
    }
}
?>