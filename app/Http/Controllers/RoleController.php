<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use Illuminate\Http\Request;

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
}
