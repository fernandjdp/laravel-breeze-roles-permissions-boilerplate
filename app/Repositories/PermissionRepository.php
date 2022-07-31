<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface 
{
    /**
     * It returns an array of all the permissions in the database.
     * 
     * @return An array of all the permissions in the database.
     */
    public function browsePermission() {
        return Permission::all()->toArray();
    }

    /**
     * &gt; This function reads the permission of the user.
     */
    public function readPermission() {

    }

    /**
     * It updates the permission data in the database.
     * 
     * @param permissionModel This is the model that you want to update.
     * @param permissionData 
     * 
     * @return The return value of the update method.
     */
    public function editPermission($permissionModel, $permissionData) {
        return $permissionModel->update($permissionData);
    }

    /**
     * It creates a new permission in the database.
     * 
     * @param permissionData An array of the permission data.
     * 
     * @return A new instance of the Permission model.
     */
    public function addPermission($permissionData) {
        return Permission::create($permissionData);
    }

    /**
     * It deletes a permission from the database
     * 
     * @param permissionModel The permission model you want to delete.
     * 
     * @return The return value of the delete() method.
     */
    public function deletePermission($permissionModel) {
        return $permissionModel->delete();
    }

    /**
     * It takes an array of permission names and a user object, and assigns the permissions to the
     * user.
     * 
     * @param permissionData An array of permission names.
     * @param user The user object
     * 
     * @return The return value is the result of the syncPermissions method.
     */
    public function assignPermissions($permissionData, $user) {
        return $user->syncPermissions($permissionData);
    }

}