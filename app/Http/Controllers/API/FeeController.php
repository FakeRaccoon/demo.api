<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeeController extends Controller
{
    public function createFee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'form_id'           => 'required',
            'fee'            => 'required',
            'description'    => 'required'
        ], [
            'form_id.required'      => 'Form id tidak boleh kosong!',
            'fee.required'          => 'Fee tidak boleh kosong!',
            'description.required'  => 'Deskripsi tidak boleh kosong!'
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 402,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];
        } else {
            $query = Fee::create([
                'form_id'         => $request->form_id,
                'fee'             => $request->fee,
                'description'     => $request->description
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
