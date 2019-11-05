<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
