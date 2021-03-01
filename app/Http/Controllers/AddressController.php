<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\Address as AddressResource;

class AddressController extends BaseController
{
    public function index()
    {
        $addresses = Address::all();

        return $this->sendResponse(AddressResource::collection($addresses), 'Addresss retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'zip_code' => 'required|size:8',
            'public_place' => 'required|max:255',
            'place_number' => 'required|max:255',
            'neighborhood' => 'required|max:255',
            'complement' => 'max:255',
            'uf' => 'required|integer',
            'user_id' => 'integer',
            'bussiness_id' => 'integer'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $address = Address::create($input);

        if(isset($input['user_id']))
            $address->users()->attach($input['user_id']);

        if(isset($input['bussiness_id']))
            $address->bussinesses()->attach($input['bussiness_id']);


        return $this->sendResponse(new AddressResource($address), 'Address created successfully.');
    }

    public function show($id)
    {
        $address = Address::find($id);

        if (is_null($address)) {
            return $this->sendError('Address not found.');
        }

        return $this->sendResponse(new AddressResource($address), 'Address retrieved successfully.');
    }

    public function update(Request $request, Address $address)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'zip_code' => 'required|size:8',
            'public_place' => 'required|max:255',
            'place_number' => 'required|max:255',
            'neighborhood' => 'required|max:255',
            'complement' => 'max:255',
            'uf' => 'required|integer',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $address->fill($input);
        $address->save();

        return $this->sendResponse(new AddressResource($address), 'Address updated successfully.');
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return $this->sendResponse([], 'Address deleted successfully.');
    }
}
