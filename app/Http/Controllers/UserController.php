<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\PermissionRepositoryInterface;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->authorizeResource(User::class);
        $this->userRepository = $userRepository;
        $this->permissionRepository = $permissionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userList = $this->userRepository->browseUser();
   
        return Inertia::render('Users/Index', [
            'items' => $userList,
            'create_url' => URL::route('users.create'),
            'modelName' => 'users'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Users/CreateAndUpdate', [
            'method' => 'create',
            'modelName' => 'users'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
         $this->userRepository->addUser($request->validated());
        return Redirect::route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/CreateAndUpdate', [
            'item' => $user,
            'method' => 'edit',
            'modelName' => 'users'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $updatedUser = $this->userRepository->editUser($user, $request->validated());
        return Redirect::route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deletedUser = $this->userRepository->deleteUser($user);
        return Redirect::route('users.index');
    }

    public function assignPermissions(User $user)
    {
        return Inertia::render('Users/AssignPermissions', [
            'user' => $user,
            'permissions' => $this->permissionRepository->browsePermissionByWildcard()
        ]);
    }
}
