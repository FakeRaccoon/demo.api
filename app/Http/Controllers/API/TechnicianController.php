<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technician;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TechnicianController extends Controller
{

    public function techname(Request $request)
    {
        $search = $request->header('name');
        $result = Technician::where('name', 'Ale')->get();

        $response = [
            'status'     => 200,
            'message'    => 'Tech found!',
            'result'     => $result
        ];

        return response()->json($response);
    }

    public function techFinal(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
           'username' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $result = Technician::where('confirmed', '1')->where('username', $request->all())->get();

        $response = [
            'status'     => 200,
            'message'    => 'Tech found!',
            'result'     => $result
        ];

        return response()->json($response);
    }

    public function clear($id)
    {
        $deleteDups = DB::table('technician')
            ->where('form_id', $id)
            ->get();

        return response()->json($deleteDups, 200);
    }

    public function create(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'form_id' => 'required',
            'username' => 'required',
            'name' => 'required',
            'warehouse' => 'required',
            'task' => 'required',
            'depart' => 'required',
            'return' => 'required'
        ]);

        if ($validator->fails()) {

            return $validator->errors();
        }

        $result = Technician::create($input);

        $response = [
            'status'     => 200,
            'message'    => 'Tech added!',
            'result'     => $result
        ];

        return response()->json($response);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'task' => 'required',
            'depart' => 'required',
            'return' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $assignment = $request->header('formId');
        $result = Technician::where('form_id', '=', $assignment)->update($data);

        $response = [
            'status'     => 200,
            'message'    => 'Data updated!',
            'result'     => $result
        ];

        return response()->json($response);
    }

    public function updateFinal(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'form_id' => 'required',
            'confirmed' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $query = Technician::where('form_id', $request->form_id)->update([
            'confirmed' => $request->confirmed,
        ]);

        if($query){

            $response = [
                'status'     => 200,
                'message'    => 'Data Updated!',
                'result'     => $request->all()
            ];
        } else {

            $response = [
                'status'     => 400,
                'message'    => 'Data gagal diproses!',
                'result'     => $request->all()
            ];

            return response()->json($response, 400);

        }

        return response()->json($response);
    }

    public function destroy($id)
    {
        $technician = Technician::findOrfail($id);
        $technician->delete();

        $response = [
            'status'     => 200,
            'message'    => 'Data updated!',
            'result'     => $technician
        ];

        return response()->json($response);
    }
}
