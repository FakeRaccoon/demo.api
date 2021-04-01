<?php

namespace App\Http\Controllers\API;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{

    public function formId($id)
    {

        $data = Form::where('id', '=', $id)
            ->get();

        $result = [];
        if ($data) {
            if ($data->count() > 0) {
                foreach ($data as $d) {
                    $result[] = [
                        'id'           => $d->id,
                        'province'     => $d->province,
                        'city'         => $d->city,
                        'district'     => $d->district,
                        'user'         => $d->user,
                        'item'         => $d->item,
                        'fee'          => $d->fee,
                        'transport'    => $d->transport,
                        'driver'       => $d->driver,
                        'technician'   => $d->technician,
                        'request_date' => date('Y-m-d H:i:s', strtotime($d->request_date)),
                        'type'         => $d->type(),
                        'status'       => $d->status(),
                        'reject_reason' => $d->reject_reason,
                        'image'        => $d->image,
                        'departure_date' => date('Y-m-d H:i:s', strtotime($d->departure_date)),
                        'return_date' => date('Y-m-d H:i:s', strtotime($d->return_date)),
                        'created_at'   => date('Y-m-d H:i:s', strtotime($d->created_at)),
                        'updated_at'   => date('Y-m-d H:i:s', strtotime($d->updated_at))
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

    public function getData(Request $request)
    {

        $search = $request->header('status');
        $data = Form::where('status', '=', $search)
            ->get();

        $result = [];
        if ($data) {
            if ($data->count() > 0) {
                foreach ($data as $d) {
                    $result[] = [
                        'id'           => $d->id,
                        'province'     => $d->province,
                        'city'         => $d->city,
                        'district'     => $d->district,
                        'user'         => $d->user,
                        'item_id'      => $d->item_id,
                        'item'         => $d->item,
                        'item_measure_id' => $d->item_measure_id,
                        'warehouse_id'    => $d->warehouse_id,
                        'warehouse'    => $d->warehouse,
                        'warehouse_destination' => $d->warehouse_destination,
                        'fee'          => $d->fee,
                        'transport'    => $d->transport,
                        'driver'       => $d->driver,
                        'technician'   => $d->technician,
                        'estimated_date' => date('Y-m-d H:i:s', strtotime($d->estimated_date)),
                        'type'         => $d->type(),
                        'status'       => $d->status(),
                        'image'        => $d->image,
                        'code_image'        => $d->code_image,
                        'return_image' => $d->return_image,
                        'departure_date' => date('Y-m-d H:i:s', strtotime($d->departure_date)),
                        'return_date' => date('Y-m-d H:i:s', strtotime($d->return_date)),
                        'created_at'   => date('Y-m-d H:i:s', strtotime($d->created_at)),
                        'updated_at'   => date('Y-m-d H:i:s', strtotime($d->updated_at))
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

    public function getDataV2(Request $request)
    {

        $search = $request->header('status');
        $data = Form::where('status', $search)->with('items.images')->with('technician.user')->get();

        $result = [];
        if ($data) {
            if ($data->count() > 0) {
                foreach ($data as $d) {
                    $result[] = [
                        'id'                        => $d->id,
                        'destination'               => $d->destination,
                        'user'                      => $d->user,
                        'items'                     => $d->items,
                        // 'warehouse_id'              => $d->warehouse_id,
                        // 'warehouse'                 => $d->warehouse,
                        // 'warehouse_destination'     => $d->warehouse_destination,
                        'fee'                       => $d->fee,
                        'transport'                 => $d->transport,
                        'driver'                    => $d->driver,
                        'technician'                => $d->technician,
                        'estimated_date'            => date('Y-m-d H:i:s', strtotime($d->estimated_date)),
                        'type'                      => $d->type(),
                        'status'                    => $d->status(),
                        'reject_reason'             => $d->reject_reason,
                        'departure_date'            => date('Y-m-d H:i:s', strtotime($d->departure_date)),
                        'return_date'               => date('Y-m-d H:i:s', strtotime($d->return_date)),
                        'created_at'                => date('Y-m-d H:i:s', strtotime($d->created_at)),
                        'updated_at'                => date('Y-m-d H:i:s', strtotime($d->updated_at))
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

    public function formStatusUpdate($status, $id)
    {
        $form = Form::where('id', '=', $id)
            ->update(['status' => $status]);

        return 'Status Successfully udated.';
    }

    public function createForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'province_id'  => 'required',
            'city_id'      => 'required',
            'item_id' => 'required',
            'item'      => 'required',
            'item_measure_id' => 'required',
            'type'         => 'required',
            'user_id'      => 'required',
            'status'       => 'required',
            'estimated_date' => 'required'
        ], [
            'province_id.required' => 'Harap memilih provinsi!',
            'city_id.required'     => 'Harap memilih kota!',
            'item_id.required' => 'Item id required',
            'item.required'     => 'Harap memilih barang!',
            'type.required'        => 'Harap memilih tipe demo!',
            'user_id.required'     => 'User tidak boleh kosong!',
            'status.required'      => 'Status tidak boleh kosong!',
            'status.estimated_date'  => 'Tanggal permintaan tidak boleh kosong!'
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 402,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];
        } else {
            $query = Form::create([
                'province_id'  => $request->province_id,
                'city_id'      => $request->city_id,
                'district_id'  => $request->district_id,
                'user_id'      => $request->user_id,
                'item_id' => $request->item_id,
                'item_measure_id' => $request->item_measure_id,
                'item'      => $request->item,
                'estimated_date' => $request->estimated_date,
                'type'         => $request->type,
                'status'       => $request->status
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

    public function createFormV2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'destination' => 'required',
            'type'         => 'required',
            'user_id'      => 'required',
            'status'       => 'required',
            'estimated_date' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {
            $query = Form::create([
                'destination' => $request->destination,
                'user_id'      => $request->user_id,
                'estimated_date' => $request->estimated_date,
                'type'         => $request->type,
                'status'       => $request->status
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

    public function statusUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $query = Form::where('id', $request->id)->update([
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
                'status'  => 500,
                'message' => 'Data gagal diproses!',
                'result'  => $request->all()
            ];
        }
        return response()->json($response);
    }

    public function statusAndRejecReasonUpdate(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'id' => 'required',
            'status' => 'required',
            'reject_reason' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $form = Form::where('id', $request->id)->update($data);

        if ($form) {
            $response = [
                'status'  => 200,
                'message' => 'Data berhasil diproses!',
                'result'  => $form
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Data gagal diproses!',
                'result'  => $request->all()
            ];
        }

        return response()->json($response);
    }

    public function formUpdate(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'id' => 'required',
            'status' => 'required',
            'warehouse' => 'required',
            'warehouse_destination' => 'required',
            'transport_id' => 'nullable',
            'driver_id' => 'nullable',
            'departure_date' => 'required',
            'return_date' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $form = Form::where('id', $request->id)->update($data);

        if ($form) {
            $response = [
                'status'  => 200,
                'message' => 'Data berhasil diproses!',
                'result'  => $form
            ];
        } else {
            $response = [
                'status'  => 400,
                'message' => 'Data gagal diproses!',
                'result'  => $request->all()
            ];

            return response()->json($response, 400);
        }

        return response()->json($response);
    }

    public function formUpdatev2(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',
            'transport_id' => 'nullable',
            'driver_id' => 'nullable',
            'departure_date' => 'required',
            'return_date' => 'required',
        ]);

        if ($validator->fails()) {

            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        }

        $form = Form::where('id', $request->id)->update($request->all());

        if ($form) {
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

        return response()->json($response);
    }

    public function imageUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $query = Form::where('id', $request->id)->update([
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
                'status'  => 500,
                'message' => 'Data gagal diproses!',
                'result'  => $request->all()
            ];
        }
        return response()->json($response);
    }

    public function codeImageUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'code_image' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $query = Form::where('id', $request->id)->update([
            'code_image' => $request->code_image,
        ]);

        if ($query) {
            $response = [
                'status'  => 200,
                'message' => 'Data berhasil diproses!',
                'result'  => $request->all()
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Data gagal diproses!',
                'result'  => $request->all()
            ];
        }
        return response()->json($response);
    }

    public function returnImageUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'return_image' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $query = Form::where('id', $request->id)->update([
            'return_image' => $request->return_image,
        ]);

        if ($query) {
            $response = [
                'status'  => 200,
                'message' => 'Data berhasil diproses!',
                'result'  => $request->all()
            ];
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Data gagal diproses!',
                'result'  => $request->all()
            ];
        }
        return response()->json($response);
    }

    public function destroy(Form $Item)
    {
        $Item->delete();

        return $this->sendResponse([], 'Item deleted successfully.');
    }
}
