<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface 
{
    public function browsePermission() {
        return Permission::all()->toArray();
    }

    public function browsePermissionByWildcard() {
        $permissionsByWildcards = [];
        
        $permissionList = Permission::all()->pluck('name')->toArray();

        $models = $this->getPermissionParts($permissionList, 0);
        $wildcardsArray = $this->getPermissionParts($permissionList, 1);
        
        foreach ($models as $model) {
           array_push($permissionsByWildcards, [$model => $wildcardsArray]);
        }
        
        return $permissionsByWildcards;
    }

    private function getPermissionParts($permissionList, $part) {

        $permissions = array_map(function ($permission) use ($part) {
            return explode('.',$permission)[$part];
        }, $permissionList);

        return array_unique($permissions);
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