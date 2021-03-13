<?php

namespace App\Http\Controllers\API;

use App\Models\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller
{
    public function createLog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activity'  => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 402,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];
        } else {
            $query = Log::create([
                'activity'  => $request->activity,
            ]);

            if ($query) {
                $response = [
                    'status'  => 200,
                    'message' => 'Data berhasil diproses!',
                    'result'  => $query
                ];
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Data gagal diproses!',
                    'result'  => $request->all()
                ];
            }
        }

        return response()->json($response);
    }
}
