<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getData(Request $request)
    {
        $data = Notification::where(function($query) use ($request) {
            if($request->has('id')) {
                $query->where('id', $request->id);
            }

            if($request->has('user_id')) {
                $query->where('user_id', $request->user_id);
            }
        })
        ->get();

        $result = [];
        if($data) {
            if($data->count() > 0) {
                foreach($data as $d) {
                    $result[] = [
                        'id'          => $d->id,
                        'user_id'     => $d->user_id,
                        'user'        => $d->user,
                        'title'=> $d->title,
                        'content'=> $d->content,
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
