<?php

namespace App\Scopes\VodeaCore;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserRoleScope implements Scope {
	protected $role;

	public function __construct($role) {
		$this->role = $role;
	}


	public function apply(Builder $builder, Model $model) {
		$builder->whereHas('roles', function ($q) {
			$q->where('name', $this->role);
		});
	}
}