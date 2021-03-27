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

        $query = Item::where('form_id', $request->all())->get();

        if ($query) {
            $response = [
                'status'  => 200,
                'message' => 'Data berhasil diproses!',
                'result'  => $query
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
            $query = Item::create([
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
