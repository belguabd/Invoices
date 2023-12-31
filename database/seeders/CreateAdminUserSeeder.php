<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        $user = User::create([
            'name' => 'brahimlguabdi',
            'email' => 'admin@rscoder.com',
            'password' => bcrypt('123456'),
            'roles_name'=>["owner"],
            'status'=>'مفعل'
        ]);
        // Create an "Admin" role
        $role = Role::create(['name' => 'Admin']);

        // Get all permissions and pluck their IDs
        $permissions = Permission::pluck('id')->toArray();

        // Sync the permissions with the role
        $role->syncPermissions($permissions);
        // Assign the role to the user
        $user->assignRole([$role->id]);
    }
}
