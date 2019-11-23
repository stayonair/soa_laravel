<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    // user_id は mass assignment で割当可能にしたいので guarded に入れない
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
}
