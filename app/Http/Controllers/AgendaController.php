<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Services\AgendaService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AgendaController extends Controller
{
    public  function index(Request $request)
    {
        try {
            return Inertia::render('Belakang/Agenda', [
                'agendas' => Agenda::all(),
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->data;
            Agenda::updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                [
                    'nama' => $data['nama'],
                    'mulai' => $data['mulai'],
                    'selesai' => $data['selesai'],
                    'lokasi' => $data['lokasi'],
                    'pelaksana' => $data['pelaksana'],
                    'deskripsi' => $data['deskripsi'],
                    'status' => $data['status'] ?? true
                ]
            );

            return back()->with('message', 'Agenda ditambahkan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Agenda $agenda, $id)
    {
        Agenda::destroy($id);
        return back()->with('message', 'Agenda dihapus');
    }

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
