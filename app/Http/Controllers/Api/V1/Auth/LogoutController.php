<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{

/**
     * @OA\GET(
     *      path="/api/v1/auth/logout",
     *      summary="Logout",
     *      tags={"Authentication-system"},
     * 
     *      @OA\Response(
     *          response="200",
     *          description="Logout was successful",
     *      ),
     * )
     * 
     */

    public string $success_message = "You have successfully logged out";
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response([
            "message" => $this->success_message
        ]);
    }
}
