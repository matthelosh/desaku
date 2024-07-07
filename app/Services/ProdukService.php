<?php

namespace App\Services;

use App\Models\Produk;

class ProdukService
{
    public function home($request)
    {
        $queries = $request->query();
        if (count($queries) < 1) {
            $produks = Produk::orderBy('updated_at', 'DESC')->limit(9)->get();
        }
        return $produks;
    }
}
