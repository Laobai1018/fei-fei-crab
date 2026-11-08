<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Change this password after your first login.
        $admin = User::updateOrCreate(
            ['email' => 'admin@feifeicrab.test'],
            ['name' => 'Admin', 'password' => Hash::make('Admin123')]
        );
        $admin->forceFill(['is_admin' => true])->save();
    }
}
