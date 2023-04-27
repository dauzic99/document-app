<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleService
{
    public function get()
    {
        $datas = Role::with('permissions')->where('name', '!=', 'Super-Admin')->get();

        return DataTables::of($datas)->make(true);
    }
}
