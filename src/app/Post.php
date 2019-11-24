<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;

class Post extends Model
{
    protected $guarded = ['id'];

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @param Builder $builder
     * @param User $user
     * @return Builder
     */
    public function scopeByUser(Builder $builder, User $user)
    {
        return $builder->where('user_id', $user->id);
    }
}
