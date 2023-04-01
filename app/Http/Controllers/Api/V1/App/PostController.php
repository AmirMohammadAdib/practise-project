<?php

namespace App\Http\Controllers\Api\V1\App;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repository\Elequents\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private PostRepository $elequent_post) {
        $this->authorizeResource(Post::class, "post");
    }

    /**
     * @OA\GET(
     *      path="/api/v1/post",
     *      summary="Posts",
     *      tags={"Posts"},
     * 
     *      @OA\Response(
     *          response="200",
     *          description="Return all Posts",
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
        return $this->elequent_post->all();
    }
    /**
     * @OA\GET(
     *      path="/api/v1/post/{post}",
     *      summary="Show Post",
     *      tags={"Posts"},
     * 
     *      @OA\Response(
     *          response="200",
     *          description="Return a specific post",
     *      ),
     * 
     *      @OA\Response(
     *          response="403",
     *          description="this action id Unauthorized",
     *      ),
     *      
     *      @OA\Parameter(
     *          name="post",
     *          description="You must send the post ID",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *      )
     * )
     * 
     */
    public function show(Post $post)
    {
        return $this->elequent_post->show($post);
    }
}