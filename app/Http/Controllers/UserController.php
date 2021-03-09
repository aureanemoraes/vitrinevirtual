<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use App\Http\Resources\User as UserResource;

class UserController extends BaseController
{
    public function index()
    {

        $current_user = auth('api')->user();
        if($current_user->is_admin) {
            $users = User::all();
            return $this->sendResponse(UserResource::collection($users), 'Users retrieved successfully.');
        } else {

            return $this->sendResponse(UserResource::collection([$current_user]), 'Users retrieved successfully.');
        }

    }

    public function public_index()
    {
        $users = User::where('is_admin', 0)->withCount('products')->get();

        return $this->sendResponse(UserResource::collection($users), 'Users retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        if(!isset($input['social_name'])) {
            $input['social_name'] = '';
        }

        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'social_name' => 'max:255',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'cpf' => 'required|unique:users|cpf',
            'birthdate' => 'required|date',
            'rg' => 'required',
            'uf_rg' => 'required|size:2',
            'gender' => 'required|integer',
            'ethnicity' => 'required|integer',
            'civil_status' => 'required|integer',
            'scholarity' => 'required|integer',
            'bussiness_name' => 'max:255',
            'bussiness_description' => 'max:2048',
            'image' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        // Tratando imagem
        $image = $request->file('image');
        $input['imagename'] = time() . '-' . Str::random(40) . '.'. $image->extension();
        $destinationPath = public_path('profile');
        $img = \Intervention\Image\Facades\Image::make($image->path());
        $height = $img->height();
        $width = $img->width();
        if($height > 200 || $width > 200) {
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath. '\\' . $input['imagename']);
        } else {
            $img->save($destinationPath. '\\' . $input['imagename']);
        }

        $user->image_path = $input['imagename'];
        $user->save();

        return $this->sendResponse(new UserResource($user), 'User created successfully.');
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

        if(!isset($input['password'])) {
            $input['password'] = $user->password;
        }

        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'social_name' => 'max:255',
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'cpf' => 'required|cpf|unique:users,cpf,' . $user->id,
            'birthdate' => 'required|date',
            'rg' => 'required',
            'uf_rg' => 'required',
            'gender' => 'required|integer',
            'ethnicity' => 'required|integer',
            'civil_status' => 'required|integer',
            'scholarity' => 'required|integer',
            'bussiness_name' => 'max:255',
            'bussiness_description' => 'max:2048',
            'image' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user->fill($input);
        $user->save();

        // Tratando imagem
        // Verificando se já existe uma imagem de perfil
        // Se não existir, armazenar a imagem
        // Se existir, excluir o arquivo da imagem, salvar a nova imagem e armazenar o novo caminho
        if($request->hasFile('image')) {
            if(isset($user->image_path)) {
                $image_path = public_path('/profile/') . $user->image_path;
                if (file_exists($image_path))
                    @unlink($image_path);

                $image = $request->file('image');
                $input['imagename'] = time() . '-' . Str::random(40) . '.'. $image->extension();
                $destinationPath = public_path('profile');
                $img = \Intervention\Image\Facades\Image::make($image->path());
                $height = $img->height();
                $width = $img->width();
                if($height > 200 || $width > 200) {
                    $img->resize(200, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath. '\\' . $input['imagename']);
                } else {
                    $img->save($destinationPath. '\\' . $input['imagename']);
                }

                $user->image_path = $input['imagename'];
                $user->save();

            } else {
                $image = $request->file('image');
                $input['imagename'] = time() . '-' . Str::random(40) . '.'. $image->extension();
                $destinationPath = public_path('profile');
                $img = \Intervention\Image\Facades\Image::make($image->path());
                $height = $img->height();
                $width = $img->width();
                if($height > 200 || $width > 200) {
                    $img->resize(200, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath. '\\' . $input['imagename']);
                } else {
                    $img->save($destinationPath. '\\' . $input['imagename']);
                }

                $user->image_path = $input['imagename'];
                $user->save();
            }
        }

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
