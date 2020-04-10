<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Contracts\Auth\Authenticatable;

class ApiToken extends PersonalAccessToken
{
    public $table = 'personal_access_tokens';

    public static function forUser(Authenticatable $entity): Builder
    {
        if($entity->isRole('admin')){
            return static::query();
        }
        return $entity->tokens()->getQuery();
    }

    public static function allAbilities(): Collection
    {
        return static::query()
            ->pluck('abilities')
            ->flatten(1)
            ->unique()
            ->values();
    }
}
