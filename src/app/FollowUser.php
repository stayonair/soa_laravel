<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FollowUser extends Pivot
{
    protected $guarded = ['id'];

    /**
     * @return BelongsToMany
     */
    public function followUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            self::class,
            'follow_users',
            'user_id',
            'followed_user_id'
        )
            ->using(FollowUser::class);
    }
}
