<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use App\Http\Resources\Phone as PhoneResource;
use Validator;

class PhoneController extends BaseController
{
    public function index()
    {
        $phones = Phone::all();

        return $this->sendResponse(PhoneResource::collection($phones), 'Phones retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        if(!isset($input['is_whatsapp']))
            $input['is_whatsapp'] = 0;

        $validator = Validator::make($input, [
            'number_phone' => 'required|size:15',
            'type_phone' => 'required|max:255',
            'is_whatsapp' => 'boolean',
            'user_id' => 'integer',
            'bussiness_id' => 'integer'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $phone = Phone::create($input);

        if(isset($input['user_id']))
            $phone->users()->attach($input['user_id']);

        if(isset($input['bussiness_id']))
            $phone->bussinesses()->attach($input['bussiness_id']);

        return $this->sendResponse(new PhoneResource($phone), 'Phone created successfully.');
    }

    public function show($id)
    {
        $phone = Phone::find($id);

        if (is_null($phone)) {
            return $this->sendError('Phone not found.');
        }

        return $this->sendResponse(new PhoneResource($phone), 'Phone retrieved successfully.');
    }

    public function update(Request $request, Phone $phone)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'number_phone' => 'required|size:8',
            'type_phone' => 'required|max:255',
            'is_whatsapp' => 'boolean'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $phone->number_phone = $input['number_phone'];
        $phone->type_phone = $input['type_phone'];
        $phone->is_whatsapp = $input['is_whatsapp'];

        $phone->save();

        return $this->sendResponse(new PhoneResource($phone), 'Phone updated successfully.');
    }

    public function destroy(Phone $phone)
    {
        $phone->delete();

        return $this->sendResponse([], 'Phone deleted successfully.');
    }
}
