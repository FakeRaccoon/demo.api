<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentalController extends Controller
{
    public function rental()
    {
        $data = Rental::all();

        $result = [];
        if ($data) {
            if ($data->count() > 0) {
                foreach ($data as $d) {
                    $result[] = [
                        'id'                => $d->id,
                        'transport'         => $d->transport,
                        'driver'            => $d->driver,
                        'status'            => $d->status,
                        'description'       => $d->description,
                        'rental_date'       => date('Y-m-d H:i:s', strtotime($d->rental_date)),
                        'return_date'       => date('Y-m-d H:i:s', strtotime($d->return_date)),
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

    public function rentalStatus(Request $request)
    {
        $data = Rental::where('status', $request->all())->orderBy('id', 'DESC')->get();

        $validator = Validator::make($request->all(), [
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];
            return response()->json($response, 400);
        } else {
            $result = [];
            if ($data) {
                if ($data->count() > 0) {
                    foreach ($data as $d) {
                        $result[] = [
                            'id'                => $d->id,
                            'transport'         => $d->transport,
                            'driver'            => $d->driver,
                            'status'            => $d->status,
                            'description'       => $d->description,
                            'rental_date'       => date('Y-m-d H:i:s', strtotime($d->rental_date)),
                            'return_date'       => date('Y-m-d H:i:s', strtotime($d->return_date)),
                            'created_at'        => date('Y-m-d H:i:s', strtotime($d->created_at)),
                            'updated_at'        => date('Y-m-d H:i:s', strtotime($d->updated_at))
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
        }
        return response()->json($response);
    }

    public function rentalPerUser(Request $request)
    {
        $data = Rental::where('driver_id', $request->all())->orderBy('id', 'DESC')->get();

        $validator = Validator::make($request->all(), [
            'driver_id' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];
            return response()->json($response, 400);
        } else {
            $result = [];
            if ($data) {
                if ($data->count() > 0) {
                    foreach ($data as $d) {
                        $result[] = [
                            'id'                => $d->id,
                            'transport'         => $d->transport,
                            'driver'            => $d->driver,
                            'status'            => $d->status,
                            'description'       => $d->description,
                            'rental_date'       => date('Y-m-d H:i:s', strtotime($d->rental_date)),
                            'return_date'       => date('Y-m-d H:i:s', strtotime($d->return_date)),
                            'created_at'        => date('Y-m-d H:i:s', strtotime($d->created_at)),
                            'updated_at'        => date('Y-m-d H:i:s', strtotime($d->updated_at))
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
        }
        return response()->json($response);
    }

    public function createData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transport_id'  => 'required',
            'driver_id' => 'required',
            'rental_date' => 'required',
            'return_date' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];
            return response()->json($response, 400);
        } else {
            $query = Rental::create([
                'transport_id'  => $request->transport_id,
                'driver_id'  => $request->driver_id,
                'description' =>$request->description,
                'rental_date'  => $request->rental_date,
                'return_date'  => $request->return_date,
            ]);

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

    public function updateRentalStatus(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required'
        ], [
            'id.required' => 'ID tidak boleh kosong!'
        ]);

        if ($validator->fails()) {

            return $validator->errors();
        } else {

            $query = Rental::where('id', $request->id)->update([
                'status' => $request->status,
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
