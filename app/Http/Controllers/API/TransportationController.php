<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transportation;
use Illuminate\Support\Facades\Validator;

class TransportationController extends Controller
{
    public function transportation()
    {
        $data = Transportation::with('history.driver')->get();

        $result = [];
        if ($data) {
            if ($data->count() > 0) {
                foreach ($data as $d) {
                    $result[] = [
                        'id'                => $d->id,
                        'name'              => $d->name,
                        'plat'              => $d->plat_no,
                        'kilometer'         => $d->kilometer,
                        'image'             => $d->image,
                        'idle'              => $d->idle,
                        'rental_date'       => date('Y-m-d H:i:s', strtotime($d->rental_date)),
                        'return_date'       => date('Y-m-d H:i:s', strtotime($d->return_date)),
                        'history'           => $d->history,
                        // 'created_at'        => date('Y-m-d H:i:s', strtotime($d->created_at)),
                        // 'updated_at'        => date('Y-m-d H:i:s', strtotime($d->updated_at))
                    ];
                }

                $response = [
                    'status'     => 200,
                    'message'    => 'Data ditemukan!',
                    'total_data' => count($result),
                    'result'     => $result
                ];
            } else {
                $response = [
                    'status'     => 404,
                    'message'    => 'Data tidak ditemukan!',
                    'total_data' => count($result),
                    'result'     => $result
                ];
            }
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Server error!'
            ];
        }

        return response()->json($response);
    }

    public function transportationDetail($id)
    {
        $data = Transportation::where('id', $id)->with('history.driver')->get();

        $result = [];
        if ($data) {
            if ($data->count() > 0) {
                foreach ($data as $d) {
                    $result[] = [
                        'id'                => $d->id,
                        'name'              => $d->name,
                        'plat'              => $d->plat_no,
                        'kilometer'         => $d->kilometer,
                        'image'             => $d->image,
                        'idle'              => $d->idle,
                        'rental_date'       => date('Y-m-d H:i:s', strtotime($d->rental_date)),
                        'return_date'       => date('Y-m-d H:i:s', strtotime($d->return_date)),
                        'history'           => $d->history,
                        // 'created_at'        => date('Y-m-d H:i:s', strtotime($d->created_at)),
                        // 'updated_at'        => date('Y-m-d H:i:s', strtotime($d->updated_at))
                    ];
                }

                $response = [
                    'status'     => 200,
                    'message'    => 'Data ditemukan!',
                    'total_data' => count($result),
                    'result'     => $result
                ];
            } else {
                $response = [
                    'status'     => 404,
                    'message'    => 'Data tidak ditemukan!',
                    'total_data' => count($result),
                    'result'     => $result
                ];
            }
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Server error!'
            ];
        }

        return response()->json($response);
    }

    public function createData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 402,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];
        } else {
            $query = Transportation::create([
                'name'  => $request->name,
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

    public function updateTransport(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ], [
            'id.required' => 'ID tidak boleh kosong!'
        ]);

        if ($validator->fails()) {

            return $validator->errors();
        } else {

            $query = Transportation::where('id', $request->id)->update([
                'plat_no' => $request->plat_no,
                'kilometer'  => $request->kilometer,
                'idle'      => $request->idle,
                'image' => $request->image,
            ]);

            if ($query) {
                $response = [
                    'status'  => 200,
                    'message' => 'Data berhasil diproses!',
                    'result'  => $request->all()
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
