<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function browseUser();
    public function readUser();
    public function editUser($userModel, $userData);
    public function addUser($userData);
    public function deleteUser($userModel);
}
