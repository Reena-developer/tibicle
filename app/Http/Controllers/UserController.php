<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWTManager as JWT;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class UserController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mobile_num' => 'required|digits:10'
        ]);
        $photo_name = '';
        if ($request->hasFile('photo')) {
            $photo_name = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('images'), $photo_name);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photo_name,
            'mobile_num' => $request->mobile_num,
            'role' => '2'
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user','token'), 201);
    }

    public function login(Request $request){
        $credentials = $request->json()->all();

        try {
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json(['error'=>'invalid Credentials'], 400);
            }
        }catch (JWTException $e){
            return response()->json(['error'=>'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));

    }

    public function getAuthenticatedUser(){
        try{
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['user_not_found'], 400);
            }
        }catch (TokenExpiredException $e){
            return response()->json(['token_expired'], $e->getStatusCode());
        }catch (TokenInvalidException $e){
            return response()->json(['token_invalid'], $e->getStatusCode());
        }catch (JWTException $e){
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

    public function getUser()
    {
        $user = User::where(['role'=>'2'])->get();
        return response()->json($user);
    }

    public function edit(Request $request, $id) {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_num' => 'required|digits:10'
        ]);
        

        $user = User::find($id);
        if (!$user) {
            return response()->json(['error'=>'invalid user.'], 400);
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile_num = $request->mobile_num;

        if ($request->hasFile('photo')) {
            $photo_name = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('images'), $photo_name);
            $user->photo = $photo_name;
        }

        if ($user->save()) {
            return response()->json(['error'=>'Update successfully.'], 200);
        } else {
            return response()->json(['error'=>'Something want wrong, Please try latter.'], 400);
        }
    }  

    public function delete($id)
    {
        $delete = User::destroy($id);
        if ($delete) {
            return response()->json(['error'=>'delete successfully.'], 200);
        } else {
            return response()->json(['error'=>'Something want wrong, Please try latter.'], 400);
        }
        
    }
}