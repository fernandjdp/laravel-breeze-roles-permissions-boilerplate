<?php

namespace Database\Seeders\Backoffice;

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
                    ['name' => $modelName.'.*', 'guardName' => 'api'],
                    ['name' => $modelName.'.viewAny', 'guardName' => 'api'],
                    ['name' => $modelName.'.view', 'guardName' => 'api'],
                    ['name' => $modelName.'.create', 'guardName' => 'api'],
                    ['name' => $modelName.'.update', 'guardName' => 'api'],
                    ['name' => $modelName.'.delete', 'guardName' => 'api'],
                    ['name' => $modelName.'.restore', 'guardName' => 'api'],
                    ['name' => $modelName.'.forceDelete', 'guardName' => 'api']
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
                ['name' => 'roles.*', 'guardName' => 'api'],
                ['name' => 'roles.viewAny', 'guardName' => 'api'],
                ['name' => 'roles.view', 'guardName' => 'api'],
                ['name' => 'roles.create', 'guardName' => 'api'],
                ['name' => 'roles.update', 'guardName' => 'api'],
                ['name' => 'roles.delete', 'guardName' => 'api'],
                ['name' => 'roles.restore', 'guardName' => 'api'],
                ['name' => 'roles.forceDelete', 'guardName' => 'api'],
                ['name' => 'permissions.*', 'guardName' => 'api'],
                ['name' => 'permissions.viewAny', 'guardName' => 'api'],
                ['name' => 'permissions.view', 'guardName' => 'api'],
                ['name' => 'permissions.create', 'guardName' => 'api'],
                ['name' => 'permissions.update', 'guardName' => 'api'],
                ['name' => 'permissions.delete', 'guardName' => 'api'],
                ['name' => 'permissions.restore', 'guardName' => 'api'],
                ['name' => 'permissions.forceDelete', 'guardName' => 'api']
                
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
            'guardName' => 'api'
        ]);

        return var_dump('Superadmin role creted successfully');
    }
}
