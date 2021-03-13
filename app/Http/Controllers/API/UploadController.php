<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    public function uploadTest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 402,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];
        } else {
            $query = $request->file('img')->store('images');

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

    public function uploadTransport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img' => 'required',
        ]);

        if ($validator->fails()) {

            return $validator->errors();

        } else {
            $query = $request->file('img')->store('images/transport');

            if ($query) {
                $response = [
                    'status'  => 200,
                    'message' => 'Data berhasil diproses!',
                    'result'  => $query
                ];
            } else {
                $response = [
                    'status'  => 400,
                    'message' => 'Data gagal diproses!',
                    'result'  => $request->all()
                ];

                return response()->json($response, 400);
            }
        }

        return response()->json($response);
    }

    public function deleteImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img' => 'required',
        ]);

        if ($validator->fails()) {

            return $validator->errors();

        } else {
            $query = Storage::delete($request->all());

            if ($query) {
                $response = [
                    'status'  => 200,
                    'message' => 'Data berhasil diproses!',
                    'result'  => $query
                ];
            } else {
                $response = [
                    'status'  => 400,
                    'message' => 'Data gagal diproses!',
                    'result'  => $request->all()
                ];

                return response()->json($response, 400);
            }
        }

        return response()->json($response);
    }
}
