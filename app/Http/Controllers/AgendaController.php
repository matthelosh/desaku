<?php

namespace App\Http\Controllers;

use App\Services\AgendaService;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function vcalendar(Request $request, AgendaService $agendaService)
    {
        try {
            return back()->with([
                'agendas' => $agendaService->home($request),
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
