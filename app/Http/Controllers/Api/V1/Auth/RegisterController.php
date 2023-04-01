<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Repository\Elequents\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct(private UserRepository $elequent_user)
    {
    }


    /**
     * @OA\POST(
     *      path="/api/v1/auth/register",
     *      summary="Register",
     *      tags={"Authentication-system"},
     * 
     *      @OA\Response(
     *          response="200",
     *          description="Registration was successful",
     *      ),

     *      @OA\Parameter(
     *          name="email",
     *          description="email field",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     * 
     *      @OA\Parameter(
     *          name="name",
     *          description="name field",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     * 
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

    public function register(UserRequest $requesr)
    {
        $user = $this->elequent_user->store($requesr->toDTO());

        return response([
            "data" => $requesr->all(),
            "message" => "Registration was successful",
            "token" => $user->createToken("register_token")->plainTextToken,
        ]);
    }
}