<?php

namespace App\Traits;

use App\Models\User;

/**
 * Trait BelongsToUser.
 *
 * @property \App\Models\User $user
 */
trait BelongsToUser
{
    public static function bootBelongsToUser(): void
    {
        static::saving(function ($model): void {
            if (!$model->user_id) {
                $model->user_id = \auth()->id() ?? User::SYSTEM_USER_ID;
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * @param \App\Models\User|int $user
     *
     * @return bool
     */
    public function isOwnedBy($user): bool
    {
        if ($user instanceof User) {
            $user = $user->id;
        }

        return $this->user_id == (int) $user;
    }
}
