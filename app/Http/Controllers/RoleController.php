<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $prefix = 'Role';

    public function index()
    {
        return view('pages.Role.index', [
            'prefix' => $this->prefix
        ]);
    }
}
