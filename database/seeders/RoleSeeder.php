<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                "name" => "super-admin",
                "description" => "فوق ادمین - دسترسی تمامیت به وبسایت",
                "model" => User::class,
            ],
        ];

        foreach($roles as $role){
            Role::create($role);
        }
    }
}
