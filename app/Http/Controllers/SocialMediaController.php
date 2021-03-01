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
            'social_medias' => 'array'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $social_media = SocialMedia::create($input);

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
            'social_medias' => 'array'

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
