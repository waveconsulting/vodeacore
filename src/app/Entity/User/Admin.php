<?php

namespace App\Entity\User;

use App\Entity\Base\User;
use App\Scopes\UserRoleScope;

class Admin extends User {
    protected static function boot() {
        static::addGlobalScope(new UserRoleScope(User::ROLE_ADMIN));
        parent::boot();
    }

    protected $fillable = [
      'name', 'email', 'password'
    ];
}
