<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{

    public function getData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'form_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $data = Item::where('form_id', $request->form_id)->get();

        $result = [];
        if ($data) {
            if ($data->count() > 0) {
                foreach ($data as $d) {
                    $result[] = [
                        'id'                    => $d->id,
                        'item_id'               => $d->item_id,
                        'item_measure_id'       => $d->item_measure_id,
                        'item_name'             => $d->item_name,
                        'demo_type'             => $d->demo_type,
                        'warehouse_id'          => $d->warehouse_id,
                        'warehouse'             => $d->warehouse,
                        'image'                 => $d->images,
                        'created_at'            => date('Y-m-d H:i:s', strtotime($d->created_at)),
                        'updated_at'            => date('Y-m-d H:i:s', strtotime($d->updated_at))
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

                return response()->json($response, 404);
            }
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Server error!'
            ];
        }

        return response()->json($response);
    }

    public function createItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'form_id'  => 'required',
            'item_id'      => 'required',
            'item_name' => 'required',
            'item_measure_id'      => 'required',
            'warehouse_id' => 'nullable',
            'warehouse' => 'nullable',
            'demo_type' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {
            $query = Item::create([
                'form_id'  => $request->form_id,
                'item_id'      => $request->item_id,
                'item_name'  => $request->item_name,
                'item_measure_id'      => $request->item_measure_id,
                'warehouse_id' => $request->warehouse_id,
                'warehouse' => $request->warehouse,
                'demo_type'      => $request->demo_type,
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

    public function updateItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'warehouse_id'  => 'required',
            'warehouse'      => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {
            $query = Item::where('id', $request->id)->update([
                'warehouse_id'  => $request->warehouse_id,
                'warehouse'      => $request->warehouse,
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
