<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{

    public function user(Request $request)
    {

        $search = $request->header('search');
        $result = User::where('name', 'LIKE', '%' . $search . '%')
            ->get();
        $response = [
            'status'     => 200,
            'message'    => 'Data ditemukan!',
            'total_data' => count($result),
            'result'     => $result
        ];

        return response()->json($response);
    }

    public function updateUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ], [
            'id.required' => 'ID tidak boleh kosong!'
        ]);

        if ($validator->fails()) {

            return $this->sendError('Validation Error.', $validator->errors());
            
        } else {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required',
                'role' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $query = User::where('id', $request->id)->update([
                'name'  => $request->name,
                'username'      => $request->username,
                'role' => $request->role,
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

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'username' => 'required|min:3',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['username'] =  $user->username;

        return $this->sendResponse($success, 'User register successfully.');
    }


    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            $success['id'] = $user->id;
            $success['username'] =  $user->username;
            $success['name'] = $user->name;
            $success['role'] = $user->role;
            $success['token'] =  $user->createToken('MyApp')->accessToken;


            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
