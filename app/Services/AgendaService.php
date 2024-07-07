<?php

namespace App\Services;

use App\Models\Agenda;

class AgendaService
{
    public function home($request)
    {
        $queries = $request->query();
        $year = $queries['tahun'] ?? date('Y');
        $month = $queries['bulan'] ?? date('m');
        return Agenda::whereYear('mulai', $year)->get();
    }
}
