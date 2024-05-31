<?php

namespace App\Exports;

use App\Models\{Component, User};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\{FromView, WithColumnWidths, WithStyles, WithDrawings, WithBackgroundColor};
use PhpOffice\PhpSpreadsheet\Worksheet\{Drawing, Worksheet};
use PhpOffice\PhpSpreadsheet\Style\{Alignment, Border, Color, Fill};

class ComponentExport implements FromView, WithColumnWidths, WithStyles, WithDrawings, WithBackgroundColor
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

    public function backgroundColor()
    {
        return '#EAE1E0';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Styling an entire row.
            2 => [
                'font' => [
                    'size' => 16, 'bold' => true
                ]
            ],
            'A5:E5' => [
                'font' => [
                    'size' => 16, 'bold' => true
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'borders' => [
                    'bottom' => [
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => [
                            'rgb' => '808080'
                        ]
                    ],
                    'top' => [
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => [
                            'rgb' => '808080'
                        ]
                    ],
                    'left' => [
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => [
                            'rgb' => '808080'
                        ]
                    ],
                    'right' => [
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => [
                            'rgb' => '808080'
                        ]
                    ],
                ],
                'fillType'   => Fill::FILL_GRADIENT_LINEAR,
                'startColor' => ['argb' => Color::COLOR_RED],
            ],

            // Styling a specific cell by coordinate.
            'C3' => ['font' => ['size' => 12, 'italic' => true]],

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
        $drawing->setCoordinates('B2');
        return $drawing;
    }

    public function view(): View
    {
        $isAdmin = false;
        $centro = '';
        $userAuth = User::where('id', Auth::user()->id)->first();

        if ($userAuth->getRoleNames()[0] === 'Admin') {
            $components = Component::all();
            $isAdmin = true;
        }else{
            $components = Component::centro($userAuth->centro_id)->get();
            $centro = $userAuth->centro->name;
        }

        return view('exports.ExcelComponents', compact('isAdmin', 'components', 'centro'));
    }
}
