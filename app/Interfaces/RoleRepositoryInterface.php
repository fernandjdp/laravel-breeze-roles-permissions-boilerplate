<?php

namespace App\Interfaces;

interface RoleRepositoryInterface 
{
    public function browseRole();
    public function readRole();
    public function editRole();
    public function addRole();
    public function deleteRole();
}
