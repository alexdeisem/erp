<?php declare(strict_types=1);

namespace App\Entity\User;

interface UserRoles
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MANAGER = 'manager';
    public const ROLE_EMPLOYEE = 'employee';
}
