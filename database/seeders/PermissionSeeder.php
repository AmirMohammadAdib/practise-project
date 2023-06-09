<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //users
            [
                "name" => User::VIEW_ANY_PERMISSION,
                "description" => "مشاهده تمامی کاربران",
                "model" => User::class,
            ],
            [
                "name" => User::VIEW_PERMISSION,
                "description" => "مشاهده جزئیات کاربر",
                "model" => User::class,
            ],
            [
                "name" => User::CREATE_PERMISSION,
                "description" => "ساختن کاربر جدید",
                "model" => User::class,
            ],
            [
                "name" => User::UPDATE_PERMISSION,
                "description" => "ویرایش اطلاعات کاربر",
                "model" => User::class,
            ],
            [
                "name" => User::DESTROY_PERMISSION,
                "description" => "حذف کاربر",
                "model" => User::class,
            ],
            [
                "name" => User::SYNC_ROLES_PERMISSION,
                "description" => "همگام سازی نقش کاربر",
                "model" => User::class,
            ],
            [
                "name" => User::SYNC_PERMISSION_PERMISSION,
                "description" => "همگام سازی مجوز های کاربر",
                "model" => User::class,
            ],

            //posts
            [
                "name" => Post::VIEW_ANY_PERMISSION,
                "description" => "مشاهده تمامی پست ها",
                "model" => Post::class,
            ],
            [
                "name" => Post::VIEW_PERMISSION,
                "description" => "مشاهده جزئیات پست",
                "model" => Post::class,
            ],
            [
                "name" => Post::CREATE_PERMISSION,
                "description" => "ساختن پست جدید",
                "model" => Post::class,
            ],
            [
                "name" => Post::UPDATE_PERMISSION,
                "description" => "ویرایش اطلاعات پست",
                "model" => Post::class,
            ],
            [
                "name" => Post::DESTROY_PERMISSION,
                "description" => "حذف پست",
                "model" => Post::class,
            ],
        ];

        foreach($permissions as $permission){
            Permission::create($permission);
        }
    }
}
