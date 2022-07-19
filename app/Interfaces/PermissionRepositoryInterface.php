<?php

namespace App\Interfaces;

interface PermissionRepositoryInterface 
{
    public function BrowsePermission();
    public function ReadPermission();
    public function EditPermission();
    public function AddPermission();
    public function DeletePermission();
}
