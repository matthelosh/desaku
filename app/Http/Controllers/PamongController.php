<?php

namespace App\Http\Controllers;

use App\Models\Pamong;
use App\Services\PamongService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PamongController extends Controller
{
    public function home(Request $request, PamongService $pamongService)
    {
        try {
            return Inertia::render('Depan/Pamong', [
                'pamongs' => $pamongService->home($request),
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function detail(Request $request, PamongService $pamongService, $nik)
    {
        try {
            $pamong = $pamongService->show($request, $nik);
            return Inertia::render('Depan/DetailPamong', [
                'pamong' => $pamong
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function index(Request $request)
    {
        try {
            $pamongs = Pamong::with('jabatan', 'warga.rt.rw.dusun')->orderBy('jabatan_id', 'ASC')->get();

            return Inertia::render('Belakang/Pamong', [
                'data' => [
                    'pamongs' => $pamongs,
                ]
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->data;
            Pamong::updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                [
                    'nik' => $data['nik'],
                    'jabatan_id' => $data['jabatan_id']
                ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
