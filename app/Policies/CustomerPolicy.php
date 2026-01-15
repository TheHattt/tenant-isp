<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use App\Roles;

class CustomerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Roles::canViewCustomers($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Customer $customer): bool
    {
        // contrast tenant_id on the user's table is the same in the customer's table
        if ($user->tenant_id !== $customer->tenant_id) {
            return false;
        }
        return Roles::canViewCustomers($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Roles::canManageCustomers($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Customer $customer): bool
    {
        if ($user->tenant_id !== $customer->tenant_id) {
            return false;
        }
        return Roles::canManageCustomers($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Customer $customer): bool
    {
        if ($user->tenant_id !== $customer->tenant_id) {
            return false;
        }
        return Roles::canManageCustomers($user);
    }
}
