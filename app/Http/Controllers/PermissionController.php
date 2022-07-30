<?php

namespace App\Http\Controllers;

use App\Interfaces\PermissionRepositoryInterface;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\AssignPermissionsRequest;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissionList = $this->permissionRepository->browsePermission();
   
        return Inertia::render('Permissions/Index', [
            'items' => $permissionList,
            'create_url' => URL::route('permissions.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Permissions/CreateAndUpdate', [
            'method' => 'create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $this->permissionRepository->addPermission($request->validated());
        return Redirect::route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return response()->json($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return Inertia::render('Permissions/CreateAndUpdate', [
            'permission' => $permission,
            'method' => 'edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @param  App\Http\Requests\PermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $updatedPermission = $this->permissionRepository->editPermission($permission, $request->validated());
        return Redirect::route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $deletedPermission = $this->permissionRepository->deletePermission($permission);
        return Redirect::route('permissions.index');
    }

    public function assignPermissions(AssignPermissionsRequest $request, User $user)
    {
        $permissionsAssigned = $this->permissionRepository->assignPermissions($request->validated()['permissionList'], $user);
        return Redirect::route('users.index');
    }
}
