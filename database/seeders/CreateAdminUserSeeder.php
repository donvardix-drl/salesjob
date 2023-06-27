<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'     => config('app.admin.name', 'Admin'),
            'email'    => config('app.admin.email', 'admin@example.com'),
            'password' => Hash::make(config('app.admin.password', Str::random())),
        ]);
        $user->markEmailAsVerified();
    }
}
