<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Item as ItemResource;

class ItemController extends BaseController
{

    public function index(Request $request)
    {
        $search = $request->header('search');
        $result = Item::where('atanaName', 'LIKE', '%' . $search . '%')
            ->get();
        $response = [
            'status'     => 200,
            'message'    => 'Data ditemukan!',
            'total_data' => count($result),
            'result'     => $result
        ];

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'itemName' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $Item = Item::create($input);

        return $this->sendResponse(new ItemResource($Item), 'Item created successfully.');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // // public function show($id)
    // // {
    // //     $Item = Item::find($id);

    // //     if (is_null($Item)) {
    // //         return $this->sendError('Item not found.');
    // //     }

    // //     return $this->sendResponse(new ItemResource($Item), 'Item retrieved successfully.');
    // // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        // return $this->sendResponse(new ItemResource($item), 'Item retrieved successfully.');
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $Item)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'itemName' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $Item->itemName = $input['itemName'];
        $Item->price = $input['price'];
        $Item->save();

        return $this->sendResponse(new ItemResource($Item), 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $Item)
    {
        $Item->delete();

        return $this->sendResponse([], 'Item deleted successfully.');
    }
}
