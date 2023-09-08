<?php

namespace App\Exports;

use App\Models\Miembro;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MiembrosCollectionExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        return (Miembro::filtros($this->request)->get())->map(function ($miembro) {
            return (object) [
                'id' => $miembro->id,
                'nombres' => $miembro->nombres,
                'apellidos' => $miembro->apellidos,
                'edad' => $miembro->tieneFechaNacimiento() ? $miembro->edad : '',
                'genero' => ucfirst($miembro->genero_biologico),
                'estado_civil' => ucfirst($miembro->estado_civil),
                'movil' => $miembro->numero_movil,
                'telefono' => $miembro->numero_telefono,
                'correo_electronico' => $miembro->correo_electronico,
                'ocupaciones' => $miembro->ocupaciones,
                'emergencias' => $miembro->emergencias,
                'membresia' => $miembro->esActivo() ? 'Activa' : 'Inactiva',
                'actualizado' => $miembro->updated_at->toDateString(),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombres',
            'Apellidos',
            'Edad',
            'Género',
            'Estado civil',
            'Móvil',
            'Teléfono',
            'Correo electrónico',
            'Ocupaciones',
            'Emergencias',
            'Membresia',
            'Actualizado'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '333333'], 
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension('all')->setRowHeight(24);
                $event->sheet->getDelegate()->getColumnDimension('all')->setWidth(24);
                $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            },
        ];
    }
}
