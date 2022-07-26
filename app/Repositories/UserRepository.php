<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface 
{
    public function browseUser() {
        return User::all()->toArray();
    }

    public function readUser() {

    }

    public function editUser($userModel, $userData) {
        return $userModel->update($userData);
    }

    public function addUser($userData) {
        return User::create($userData);
    }

    public function deleteUser($userModel) {
        return $userModel->delete();
    }

}