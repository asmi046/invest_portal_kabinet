<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\MoonshineUser;
use Illuminate\Auth\Access\HandlesAuthorization;


class MoonshineUserPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function view(MoonshineUser $user, MoonshineUser $item)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function create(MoonshineUser $user)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function update(MoonshineUser $user, MoonshineUser $item)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function delete(MoonshineUser $user, MoonshineUser $item)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function restore(MoonshineUser $user, MoonshineUser $item)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function forceDelete(MoonshineUser $user, MoonshineUser $item)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

    public function massDelete(MoonshineUser $user)
    {
        return in_array(auth()->user()->moonshineUserRole->name, ["Admin"]);
    }

}
