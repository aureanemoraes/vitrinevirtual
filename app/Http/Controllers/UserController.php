<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Address;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\User as UserResource;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::all();

        return $this->sendResponse(UserResource::collection($users), 'Users retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'social_name' => 'max:255',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'cpf' => 'required|unique:users|cpf',
            'birthdate' => 'required|date',
            'rg' => 'required',
            'uf_rg' => 'required|integer',
            'gender' => 'required|integer',
            'ethnicity' => 'required|integer',
            'civil_status' => 'required|integer',
            'scholarity' => 'required|integer',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        return $this->sendResponse(new UserResource($user), 'UserW created successfully.');
    }

    public function show($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User not found.');
        }

        return $this->sendResponse(new UserResource($user), 'User retrieved successfully.');
    }

    public function update(Request $request, User $user)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'social_name' => 'max:255',
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => 'required|confirmed|min:6',
            'cpf' => 'required|cpf|unique:users,cpf,' . $user->id,
            'birthdate' => 'required|date',
            'rg' => 'required',
            'uf_rg' => 'required|integer',
            'gender' => 'required|integer',
            'ethnicity' => 'required|integer',
            'civil_status' => 'required|integer',
            'scholarity' => 'required|integer',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user->name = $input['name'];
        $user->social_name = $input['social_name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->cpf = $input['cpf'];
        $user->birthdate = $input['birthdate'];
        $user->rg = $input['rg'];
        $user->uf_rg = $input['uf_rg'];
        $user->gender = $input['gender'];
        $user->ethnicity = $input['ethnicity'];
        $user->civil_status = $input['civil_status'];
        $user->scholarity = $input['scholarity'];
        $user->save();

        return $this->sendResponse(new UserResource($user), 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // addresses
        $addresses = $user->addresses;
        if(isset($addresses)) {
            foreach($addresses as $address) {
                $address->delete();
            }
        }
        // phones
        $phones = $user->phones;
        if(isset($phones)) {
            foreach($phones as $phone) {
                $phone->delete();
            }
        }
        // social_media
        $social_media = $user->social_media;
        if(isset($social_media)) {
            foreach($social_media as $sm) {
                $sm->delete();
            }
        }
        $user->delete();

        return $this->sendResponse([], 'User deleted successfully.');
    }
}
