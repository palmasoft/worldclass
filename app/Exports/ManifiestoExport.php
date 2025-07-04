<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ManifiestoExport implements FromView
{
    public function view(): View
    {
        return view('documentos.excel.manifiesto');
    }
}
