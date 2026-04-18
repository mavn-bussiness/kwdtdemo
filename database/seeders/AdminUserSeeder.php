<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@katosi.org'],
            [
                'name'     => 'Benedict Magandazi',
                'password' => Hash::make('Admin123'),
                'role'     => 'super_admin',
            ]
        );

        // Backfill any user with a null/empty role — default to editor, not super_admin
        User::whereNull('role')->orWhere('role', '')->update(['role' => 'editor']);
    }
}
