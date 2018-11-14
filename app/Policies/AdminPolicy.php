<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin;

class AdminPolicy extends Policy
{
    public function update(User $user, Admin $admin)
    {
        // return $admin->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Admin $admin)
    {
        return true;
    }
}
