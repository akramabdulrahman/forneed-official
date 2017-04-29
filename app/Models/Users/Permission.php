<?php

namespace App\Models\Users;
use App\Models\Users\Role;
use Illuminate\Database\Eloquent\Model;
class Permission extends Model
{
    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}