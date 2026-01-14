<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */

    public function apply(Builder $builder, Model $model): void
    {
        // if user is is_super_admin
        if (Auth::check() && Auth::user()->is_super_admin) {
            return;
        }

        // check if user is authenticated

        if (Auth::check() && ($tenantId = Auth::user()->tenant_id)) {
            $builder->where($model->getTable() . ".tenant_id", $tenantId);
        }
    }
}
