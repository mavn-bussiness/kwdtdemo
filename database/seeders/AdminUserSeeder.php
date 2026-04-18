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

        // Ensure role is correctly set in case migration ran with wrong column type
        User::where('email', 'admin@katosi.org')
            ->whereNull('role')
            ->orWhere('role', '')
            ->update(['role' => 'super_admin']);
    }
}
