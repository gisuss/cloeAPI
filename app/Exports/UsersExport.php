<?php

namespace App\Exports;

use App\Models\{User};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class UsersExport implements FromView, WithColumnWidths, WithStyles, WithDrawings
{
    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 45,
            'C' => 45,
            'D' => 45,
            'E' => 20,
            'F' => 15,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            5 => ['font' => ['size' => 16, 'bold' => true]],

            // Styling an entire column.
            'A' => ['font' => ['size' => 14, 'bold' => true]],
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo CLOE');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path() . '/images/logo/logo_cloe_positivo.png');
        $drawing->setHeight(35);
        $drawing->setCoordinates('D2');
        return $drawing;
    }

    public function view(): View
    {
        $isAdmin = false;
        $centro = '';
        $userAuth = User::where('id', Auth::user()->id)->first();

        if ($userAuth->getRoleNames()[0] === 'Admin') {
            $users = User::all();
            $isAdmin = true;
        }else{
            $users = User::where(['centro_id' => $userAuth->centro_id, 'active' => true])->get();
            $centro = $userAuth->centro->name;
        }

        return view('exports.ExcelUsers', compact('isAdmin', 'users', 'centro'));
    }
}
