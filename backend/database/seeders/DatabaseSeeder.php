<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin login — override via ADMIN_EMAIL / ADMIN_PASSWORD in .env before seeding
        // a real environment. The fallback password here is for local dev only.
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@al-falahmarketing.com')],
            [
                'name' => 'Al-Falah Admin',
                'password' => bcrypt(env('ADMIN_PASSWORD', 'change-me-now')),
                'email_verified_at' => now(),
            ]
        );

        $this->call(ServiceSeeder::class);
    }
}
