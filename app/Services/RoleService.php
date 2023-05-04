<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class RoleService
{
    public function get()
    {
        $datas = Role::query();
        $datas->with('permissions')->where('name', '!=', 'Super-Admin');

        return DataTables::of($datas)->make(true);
    }

    public function find($id)
    {
        return Role::findOrFail($id);
    }

    public function create(array $data)
    {
        Validator::make($data, [
            'name' => 'required|string|max:255|unique:roles,name',
        ], [
            'name.required' => 'Nama Role tidak boleh kosong.',
            'name.unique' => 'Nama Role sudah ada.',
        ])->validate();

        return Role::create([
            'name' => $data['name'],
        ]);
    }

    public function update(array $data, Role $role)
    {
        Validator::make($data, [
            'name' => 'required|string|max:255|' . Rule::unique('roles')->ignore($role->id),
        ], [
            'name.required' => 'Nama Role tidak boleh kosong.',
            'name.unique' => 'Nama Role sudah ada.',
        ])->validate();

        $role->update([
            'name' => $data['name'],
        ]);

        return $role;
    }

    public function delete(Role $role)
    {
        return $role->delete();
    }

    public function deleteAll(array $ids)
    {
        return Role::whereIn('id', $ids)->delete();
    }

    public function assignPermission(array $permission, Role $role)
    {
        $role->syncPermissions([$permission]);
        return true;
    }
}
