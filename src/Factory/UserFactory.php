<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\User\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}

    public function create(
        string $firstName,
        string $lastName,
        string $login,
        string $rawPassword,
        string $email,
        array $roles
    ): User
    {
        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setLogin($login);
        $user->setEmail($email);
        $user->setRoles($roles);

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $rawPassword
        );

        $user->setPassword($hashedPassword);

        return $user;
    }
}
