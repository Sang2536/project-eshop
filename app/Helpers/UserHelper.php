<?php
namespace App\Helpers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;

class UserHelper
{
    public function getRole($id = null) : Object
    {
        $roles = null;

        if (empty($id)) {
            $roles = Role::all();
        } else {
            $roles = Role::findOrFail($id);
        }

        return $roles;
    }

    public function selectDropdownForRole() : Object
    {
        $roles = Role::select('id', 'name')->pluck('name', 'id');

        return $roles;
    }

    public function createRole(array $input) : Object
    {
        $role = [
            'name' => $input['name'],
            'description' => $input['description'],
            'type' => $input['type'],
            'roles' => $input['roles'],
            'notes' => $input['notes']
        ];

        $role['rid'] = generateRandomString('012345789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 12);

        $output = Role::create($role);

        return $output;
    }

    public function getUser($id = null) : Object
    {
        $user = null;

        if (empty($id)) {
            $user = User::all();
        } else {
            $user = user::findOrFail($id);
        }

        return $user;
    }

    public function selectDropdownForUser() : Object
    {
        $user = User::select('id', DB::raw('CONCAT(name, " (Uid: ", uid, ")") as name_uid'))->pluck('name_uid', 'id');

        return $user;
    }

    public function getUserRole($id = null) : array {
        $user_roles = null;

        if (empty($id)) {
            $user_roles = UserRole::all();
        } else {
            $user_roles = UserRole::findOrFail($id);
        }

        return $user_roles;
    }

    public function createUserRole($user) {
        $input = [
            'ur_uid' => $user->id,
            'ur_rid' => 3,
            'notes' => 'User Role Created'
        ];

        $user_role = UserRole::create($input);

        $output = false;
        if (!empty($user_role)) {
            $output = true;
        }

        return $output;
    }
}
