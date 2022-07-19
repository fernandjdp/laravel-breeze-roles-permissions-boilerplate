<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\PermissionRepositoryInterface;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;

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
        return response()->json($permissionList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Inertia Component
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $createdPermission = $this->permissionRepository->addPermission($request);
        return response()->json($createdPermission);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Inertia Component
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
        $updatedPermission = $this->permissionRepository->editPermission($permission, $request);
        return response()->json($updatedPermission);
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
        return response()->json($deletedPermission);
    }
}
