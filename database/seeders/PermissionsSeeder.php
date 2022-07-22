<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\File;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->createSuperAdminPermission();

        $this->createModelsPermissions();

        $this->createAdminRelatedPermissions();
        
        return var_dump('All models have been checked');

    }

    /**
     * It will create a permission for each model in your app/Models folder
     * 
     * @return The return value is a string 'Models permissions created successfully'
     */
    private function createModelsPermissions() {
        $modelAll = File::allFiles('app/Models');

        foreach($modelAll as $model) {
            $modelName = Str::lower(Str::plural(Str::snake(pathinfo($model)['filename'], '-')));

            $permissionExists = (Permission::query()->where('name', $modelName.'.*')->count() > 0);

            if (!$permissionExists) {
                Permission::insert([
                    ['name' => $modelName.'.*', 'guard_name' => 'api'],
                    ['name' => $modelName.'.viewAny', 'guard_name' => 'api'],
                    ['name' => $modelName.'.view', 'guard_name' => 'api'],
                    ['name' => $modelName.'.create', 'guard_name' => 'api'],
                    ['name' => $modelName.'.update', 'guard_name' => 'api'],
                    ['name' => $modelName.'.delete', 'guard_name' => 'api'],
                    ['name' => $modelName.'.restore', 'guard_name' => 'api'],
                    ['name' => $modelName.'.forceDelete', 'guard_name' => 'api']
                ]);
            }
        }

        return var_dump('Models permissions created successfully');
    }

    /**
     * It checks if the permissions for the roles and permissions resource exist, if not, it creates
     * them
     * 
     * @return a string.
     */
    private function createAdminRelatedPermissions() {
        $adminRelatedPermissionsExists = (Permission::query()
                                           ->where('name', 'roles.*')
                                           ->count() > 0);
        if (!$adminRelatedPermissionsExists) {
            Permission::insert([
                ['name' => 'roles.*', 'guard_name' => 'api'],
                ['name' => 'roles.viewAny', 'guard_name' => 'api'],
                ['name' => 'roles.view', 'guard_name' => 'api'],
                ['name' => 'roles.create', 'guard_name' => 'api'],
                ['name' => 'roles.update', 'guard_name' => 'api'],
                ['name' => 'roles.delete', 'guard_name' => 'api'],
                ['name' => 'roles.restore', 'guard_name' => 'api'],
                ['name' => 'roles.forceDelete', 'guard_name' => 'api'],
                ['name' => 'permissions.*', 'guard_name' => 'api'],
                ['name' => 'permissions.viewAny', 'guard_name' => 'api'],
                ['name' => 'permissions.view', 'guard_name' => 'api'],
                ['name' => 'permissions.create', 'guard_name' => 'api'],
                ['name' => 'permissions.update', 'guard_name' => 'api'],
                ['name' => 'permissions.delete', 'guard_name' => 'api'],
                ['name' => 'permissions.restore', 'guard_name' => 'api'],
                ['name' => 'permissions.forceDelete', 'guard_name' => 'api']
                
            ]);
        }

        return var_dump('Admin related permissions created successfully');
    }

    /**
     * It creates a role called superadmin if it doesn't exist
     * 
     * @return the string 'Superadmin role created successfully'
     */
    private function createSuperAdminPermission() {
        Role::firstOrCreate([
            'name' => 'superadmin',
            'guard_name' => 'api'
        ]);

        return var_dump('Superadmin role creted successfully');
    }
}
