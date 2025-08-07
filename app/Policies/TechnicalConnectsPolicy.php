<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\TechnicalConnects;
use MoonShine\Laravel\Models\MoonshineUser;

class TechnicalConnectsPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\TechnicalConnects');
    }

    public function view(MoonshineUser $user, TechnicalConnects $item): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\TechnicalConnects');
    }

    public function create(MoonshineUser $user): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\TechnicalConnects');
    }

    public function update(MoonshineUser $user, TechnicalConnects $item): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\TechnicalConnects');
    }

    public function delete(MoonshineUser $user, TechnicalConnects $item): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\TechnicalConnects');
    }

    public function restore(MoonshineUser $user, TechnicalConnects $item): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\TechnicalConnects');
    }

    public function forceDelete(MoonshineUser $user, TechnicalConnects $item): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\TechnicalConnects');
    }

    public function massDelete(MoonshineUser $user): bool
    {
        return $user->documentTypes->contains('model', 'App\Models\TechnicalConnects');
    }
}
