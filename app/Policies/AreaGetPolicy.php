<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\AreaGet;
use App\Models\MoonshineUser;


class AreaGetPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\AreaGet');
    }

    public function view(MoonshineUser $user, AreaGet $item): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\AreaGe');
    }

    public function create(MoonshineUser $user): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\AreaGet');
    }

    public function update(MoonshineUser $user, AreaGet $item): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\AreaGet');
    }

    public function delete(MoonshineUser $user, AreaGet $item): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\AreaGet');
    }

    public function restore(MoonshineUser $user, AreaGet $item): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\AreaGe');
    }

    public function forceDelete(MoonshineUser $user, AreaGet $item): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\AreaGet');
    }

    public function massDelete(MoonshineUser $user): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\AreaGet');
    }
}
