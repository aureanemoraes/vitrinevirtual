<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Http\Resources\SocialMedia as SocialMediaResource;
use Validator;

class SocialMediaController extends BaseController

{
    public function index()
    {
        $social_media = SocialMedia::all();

        return $this->sendResponse(SocialMediaResource::collection($social_media), 'SocialMedias retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'sm_name' => 'required|max:255',
            'sm_url' => 'required|max:255',
            'user_id' => 'integer',
            'bussiness_id' => 'integer'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $social_media = SocialMedia::create($input);

        if(isset($input['user_id']))
            $social_media->users()->attach($input['user_id']);

        if(isset($input['bussiness_id']))
            $social_media->bussinesses()->attach($input['bussiness_id']);

        return $this->sendResponse(new SocialMediaResource($social_media), 'SocialMedia created successfully.');
    }

    public function show($id)
    {
        $social_media = SocialMedia::find($id);

        if (is_null($social_media)) {
            return $this->sendError('SocialMedia not found.');
        }

        return $this->sendResponse(new SocialMediaResource($social_media), 'SocialMedia retrieved successfully.');
    }

    public function update(Request $request, SocialMedia $social_media)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'sm_name' => 'required|max:255',
            'sm_url' => 'required|max:255',
            'user_id' => 'integer',
            'bussiness_id' => 'integer'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $social_media->social_medias = $input['social_medias'];

        $social_media->save();

        return $this->sendResponse(new SocialMediaResource($social_media), 'SocialMedia updated successfully.');
    }

    public function destroy(SocialMedia $social_media)
    {
        $social_media->delete();

        return $this->sendResponse([], 'SocialMedia deleted successfully.');
    }
}
