<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $prefix = 'role';
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    public function index()
    {
        return view('pages.' . $this->prefix . '.index', [
            'prefix' => $this->prefix
        ]);
    }

    public function get()
    {
        return $this->roleService->get();
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('pages.' . $this->prefix . '.create', [
            'prefix' => $this->prefix,
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $role = $this->roleService->create($request->all());

        if ($request->permissions) {
            $permissions = $request->permissions;
        } else {
            $permissions = [];
        }
        $assignPermission = $this->roleService->assignPermission($permissions, $role);

        return redirect()->route($this->prefix . '.index')
            ->with('success', 'Berhasil membuat ' . $this->prefix);
        // dd($request);
    }

    public function edit($id)
    {
        $data = $this->roleService->find($id);
        $permissions = Permission::all();
        return view('pages.' . $this->prefix . '.edit', [
            'prefix' => $this->prefix,
            'data' => $data,
            'permissions' => $permissions
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = $this->roleService->update($request->all(), $this->roleService->find($id));
        if ($request->permissions) {
            $permissions = $request->permissions;
        } else {
            $permissions = [];
        }
        $assignPermission = $this->roleService->assignPermission($permissions, $role);


        return redirect()->route($this->prefix . '.index')
            ->with('success', 'Berhasil mengubah ' . $this->prefix);
        // dd($request);
    }

    public function delete($id)
    {
        $role = $this->roleService->delete($this->roleService->find($id));
        // dd($role);
        return response()->json([
            'message' => 'Role berhasil dihapus'
        ]);
    }
}
