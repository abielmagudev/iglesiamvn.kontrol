<?php

namespace App\Http\Controllers;

use App\Exports\MiembrosViewExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
// use Maatwebsite\Excel\Excel;

class MiembroExportController extends Controller
{
    public $export;

    public $filename;

    public function __construct(Request $request)
    {
        $this->export = new MiembrosViewExport($request);

        $this->filename = sprintf('iglesiamvn_miembros_%s', now());
    }

    public function excel(Request $request)
    {
        return Excel::download(
            $this->export,
            $this->filename . '.xlsx'
        );
    }

    public function pdf(Request $request)
    {
        return Pdf::loadHTML( $this->export->view()->render() )
            ->setPaper('letter', 'landscape')
            ->download( $this->filename . '.pdf' );
    }
}
