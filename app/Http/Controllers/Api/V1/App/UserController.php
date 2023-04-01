<?php

namespace App\Http\Controllers\Api\V1\App;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\Elequents\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserRepository $elequent_user) {
        $this->authorizeResource(User::class, "user");
    }

    /**
     * @OA\GET(
     *      path="/api/v1/user",
     *      summary="Users",
     *      tags={"Users"},
     * 
     *      @OA\Response(
     *          response="200",
     *          description="Return all Users",
     *      ),
     * 
     *      @OA\Response(
     *          response="403",
     *          description="this action id Unauthorized",
     *      ),
     * )
     * 
     */
    public function index()
    {
        return $this->elequent_user->all();
    }
    /**
     * @OA\GET(
     *      path="/api/v1/user/{user}",
     *      summary="Show User",
     *      tags={"Users"},
     * 
     *      @OA\Response(
     *          response="200",
     *          description="Return a specific user",
     *      ),
     * 
     *      @OA\Response(
     *          response="403",
     *          description="this action id Unauthorized",
     *      ),
     *      
     *      @OA\Parameter(
     *          name="user",
     *          description="You must send the user ID",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *      )
     * )
     * 
     */
    public function show(User $user)
    {
        return $this->elequent_user->show($user);
    }
}