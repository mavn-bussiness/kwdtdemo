<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class EnsureAdminUser extends Command
{
    protected $signature = 'kwdt:ensure-admin
                            {--email=admin@katosi.org : Admin email}
                            {--name=Benedict Magandazi : Admin name}
                            {--password= : Password (prompted if omitted)}';

    protected $description = 'Ensure the admin user exists with the correct role in the database';

    public function handle(): int
    {
        $email    = $this->option('email');
        $name     = $this->option('name');
        $password = $this->option('password');

        if (! $password) {
            $password = $this->secret('Password for ' . $email . ' (leave blank to keep existing)');
        }

        $data = ['name' => $name, 'role' => 'super_admin'];

        if ($password) {
            $data['password'] = Hash::make($password);
        }

        $user = User::updateOrCreate(['email' => $email], $data);

        $this->info("✓ User [{$user->email}] role set to [{$user->role}]");

        // Show all admin-capable users
        $admins = User::whereIn('role', ['admin', 'super_admin', 'editor'])->get(['id', 'email', 'role']);
        $this->table(['ID', 'Email', 'Role'], $admins->toArray());

        return self::SUCCESS;
    }
}
