<?php

namespace App;
use App\Models\User;

enum Roles: string
{
    case ADMIN = "ceo";
    case SUPER_ADMIN = "super_admin";
    case HR = "hr";
    case CUSTOMER_CARE = "customer_care";
    case TECHNICIAN = "technician";
    case TECHNICIAN_LEAD = "technician_lead";
    case TECHNICIAN_MANAGER = "technician_manager";

    // who can manage customers
    public static function canManageCustomers(User $user): bool
    {
        return in_array($user->role, [
            self::ADMIN->value,
            self::SUPER_ADMIN->value,
        ]);
    }

    public static function canViewCustomers(User $user): bool
    {
        return in_array($user->role, [
            self::ADMIN->value,
            self::SUPER_ADMIN->value,
            self::HR->value,
            self::CUSTOMER_CARE->value,
        ]);
    }
}
