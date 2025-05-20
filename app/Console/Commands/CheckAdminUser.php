<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckAdminUser extends Command
{
    protected $signature = 'admin:check';
    protected $description = 'Check admin user details';

    public function handle()
    {
        $admin = User::where('email', 'admin@admin.com')->first();
        
        if (!$admin) {
            $this->error('Admin user not found!');
            return;
        }

        $this->info('Admin User Details:');
        $this->table(
            ['ID', 'Name', 'Email', 'Is Admin', 'Permissions'],
            [[
                $admin->id,
                $admin->name,
                $admin->email,
                $admin->is_admin ? 'Yes' : 'No',
                json_encode($admin->permissions)
            ]]
        );

        // Update is_admin if needed
        if (!$admin->is_admin) {
            $admin->is_admin = true;
            $admin->save();
            $this->info('Updated is_admin to true');
        }
    }
} 