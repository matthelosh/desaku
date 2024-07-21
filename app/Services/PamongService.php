<?php

namespace App\Services;

use App\Models\Pamong;

class PamongService
{
    public function home($request)
    {
        $queries = $request->query();
        if (count($queries) < 1) {
            $pamongs = Pamong::with('jabatan', 'warga')->orderBy('updated_at', 'DESC')->limit(9)->get();
        }
        return $pamongs;
    }
    public function show($request, $nik)
    {
        return Pamong::whereNik($nik)->first();
    }
}
