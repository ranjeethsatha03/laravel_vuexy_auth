<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        if ($request->has('permissions')) {
            $request->validate([
                'name' => 'required|string|unique:roles,name',
                'permissions' => 'array|required',
            ]);

            $role = Role::create(['name' => $request->name]);
            $role->permissions()->sync($request->permissions);

            return redirect()->route('users.index')->with('status', 'Role Created Successfully with Permissions');
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all(); 

        return view('roles.edit', compact('role')); 
    }

    public function update(Request $request, $id)
    {
        // Debugging: Log incoming request data
        \Log::info('Update request data:', $request->all());

        $role = Role::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array|nullable',
        ]);
        $role->name = $validatedData['name'];
        $role->save();
        $permissions = $validatedData['permissions'] ?? [];
        $role->permissions()->sync($permissions);
        \Log::info('Role after update:', $role->toArray());
        
        return redirect()->route('users.index')->with('status', 'Role Updated Successfully with Permissions');
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        return redirect()->route('users.index')->with('status', 'Role Deleted Successfully with Permissions');
    }
}
