<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{        
    public string $invalid_message = "Login is not possible for you";

    /**
     * @OA\POST(
     *      path="/api/v1/auth/login",
     *      summary="Login",
     *      tags={"Authentication-system"},
     * 
     *      @OA\Response(
     *          response="200",
     *          description="Login was successful",
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Login is not possible for you",
     *      ),
     *      
     *      @OA\Parameter(
     *          name="email",
     *          description="email field",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="password field",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      )
     * )
     * 
     */

    public function login(LoginRequest $request){
        $data = $request->only(["email", "password"]);
        if(Auth::attempt($data)){
            $user = Auth::user();
            $token = $user->createToken("login_token")->plainTextToken;
            return response([
                "data" => $user,
                "token" => $token,
                "message" => "Login was successful",
            ]);
        }

        return response([
            "data" => $data,
            "message" => $this->invalid_message,
        ], 401);
    }
}
