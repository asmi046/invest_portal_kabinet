<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\MoonShineUserRoleResource;
use MoonShine\Models\MoonshineUser;

class MoonShineUserRoleResourcePolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function view(MoonshineUser $user, MoonShineUserRoleResource $item)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function create(MoonshineUser $user)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function update(MoonshineUser $user, MoonShineUserRoleResource $item)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function delete(MoonshineUser $user, MoonShineUserRoleResource $item)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function restore(MoonshineUser $user, MoonShineUserRoleResource $item)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function forceDelete(MoonshineUser $user, MoonShineUserRoleResource $item)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function massDelete(MoonshineUser $user)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }
}