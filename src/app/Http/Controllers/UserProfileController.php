<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\User;

class UserProfileController extends Controller
{
    /**
     * @param User $user
     * @param UpdateUserProfileRequest $request
     * @throws \Throwable
     */
    public function update(User $user, UpdateUserProfileRequest $request)
    {
        $profile = $user->userProfile;
        $profile->fill($request->all())->saveOrFail();
    }
}
