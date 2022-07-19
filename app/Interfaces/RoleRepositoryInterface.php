<?php

namespace App\Interfaces;

interface RoleRepositoryInterface 
{
    public function BrowseRole();
    public function ReadRole();
    public function EditRole();
    public function AddRole();
    public function DeleteRole();
}
