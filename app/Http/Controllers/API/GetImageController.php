<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GetImageController extends Controller
{
    public function getData()
    {
        $result = Storage::get('asd.png');

        return $result;
    }
}
