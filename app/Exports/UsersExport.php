<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCsvSettings;

class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'ID', 
            'Name', 
            'Email', 
            'Phone', 
            'Address', 
            'Country ID', 
            'State ID', 
            'City', 
            'Image',
            'Created At',
            'Updated At'
        ];
    }
}
