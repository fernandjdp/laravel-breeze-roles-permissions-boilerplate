<?php

namespace App\Interfaces;

interface PermissionRepositoryInterface 
{
    public function browsePermission();
    public function browsePermissionByWildcard();
    public function readPermission();
    public function editPermission($permissionModel, $permissionData);
    public function addPermission($permissionData);
    public function deletePermission($permissionModel);
    public function assignPermissions($permissionData, $user);
}
