<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    const VIEW_ANY_PERMISSION = "post-view-any";
    const VIEW_PERMISSION = "post-view";
    const CREATE_PERMISSION = "create-post";
    const UPDATE_PERMISSION = "update-post";
    const DESTROY_PERMISSION = "destroy-post";

    protected $fillable = ["title", "body", "user_id"];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
