<?php

namespace App\Traits;

use App\Models\User;

/**
 * Trait HasCreator.
 *
 * @property \App\Models\User $creator
 */
trait BelongsToCreator
{
    public static function bootBelongsToCreator(): void
    {
        static::saving(function ($model): void {
            $model->creator_id = $model->creator_id ?? \auth()->id() ?? User::SYSTEM_USER_ID;
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id')->withTrashed();
    }

    /**
     * @param \App\Models\User|int $user
     *
     * @return bool
     */
    public function isCreatedBy($user): bool
    {
        if ($user instanceof User) {
            $user = $user->id;
        }

        return $this->creator_id == (int) $user;
    }
}
