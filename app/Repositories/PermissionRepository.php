<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface 
{
    public function browsePermission() {
        return Permission::all()->toArray();
    }

    public function readPermission() {

    }

    public function editPermission($permissionModel, $permissionData) {
        return $permissionModel->update($permissionData);
    }

    public function addPermission($permissionData) {
        return Permission::create($permissionData);
    }

    public function deletePermission($permissionModel) {
        return $permissionModel->delete();
    }

}