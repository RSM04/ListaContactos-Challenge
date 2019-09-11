<?php

namespace App\Exports;

use App\contactlist;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactListExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return contactlist::all();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Apellido',
            'Email',
            'Categorias'
        ];
    }
}
