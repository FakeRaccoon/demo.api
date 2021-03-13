<?php

namespace App\Http\Controllers\API;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller {

    public function getData(Request $request)
    {
        $data = City::where(function($query) use ($request) {
            if($request->has('id')) {
                $query->where('id', $request->id);
            }

            if($request->has('province_id')) {
                $query->where('province_id', $request->province_id);
            }
        })
        ->get();

        $result = [];
        if($data) {
            if($data->count() > 0) {
                foreach($data as $d) {
                    $result[] = [
                        'id'          => $d->id,
                        'province_id' => $d->province_id,
                        'name'        => $d->name,
                        'created_at'  => date('Y-m-d H:i:s', strtotime($d->created_at)),
                        'updated_at'  => date('Y-m-d H:i:s', strtotime($d->updated_at))
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

}
