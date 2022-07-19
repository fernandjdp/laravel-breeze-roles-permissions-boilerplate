<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface 
{
    public function browseRole() {
        return Role::all()->toArray();
    }
    
    public function readRole() {

    }
    
    public function editRole() {

    }
    
    public function addRole() {

    }
    
    public function deleteRole() {

    }
    
}