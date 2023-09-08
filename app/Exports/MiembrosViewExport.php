<?php

namespace App\Exports;

use App\Models\Miembro;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MiembrosViewExport implements FromView, ShouldAutoSize
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        return view('miembros.export', [
            'miembros' => Miembro::filtros($this->request)->get(),
            'request' => $this->request,
        ]);
    }
}
