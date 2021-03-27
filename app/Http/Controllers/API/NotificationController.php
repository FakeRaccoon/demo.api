<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function getData(Request $request)    
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $data = Notification::where('user_id', $request->user_id)->get();

        $result = [];
        if ($data) {
            if ($data->count() > 0) {
                foreach ($data as $d) {
                    $result[] = [
                        'id'          => $d->id,
                        'user'        => $d->user,
                        'title' => $d->title,
                        'content' => $d->content,
                        'read' => $d->read,
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

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'  => 'required',
            'title'      => 'required',
            'content' => 'required',
            'read' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);

        } else {
            $query = Notification::create([
                'user_id'  => $request->user_id,
                'title'      => $request->title,
                'content'  => $request->content,
                'read'      => $request->read,
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
}
