<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $attr = $request->all();

        $validator = Validator::make($attr, [
            'cpf' => 'required|cpf',
            'password' => 'required|min:6|max:255',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if(Auth::attempt($attr)){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            redirect('/login');
            return $this->sendError('Unauthorised.', ['error' => 'Credenciais incorretas.']);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->sendResponse([], 'O usuário foi deslogado.');
    }
}
