<?php

namespace App\Services;

use App\Models\Wisata;

class WisataService
{
    public function home($request)
    {
        return Wisata::paginate(4);
    }
}
