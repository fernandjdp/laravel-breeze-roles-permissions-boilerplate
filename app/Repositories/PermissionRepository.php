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

    }

    public function addPermission($permissionData) {

    }

    public function deletePermission($permissionModel) {

    }

}