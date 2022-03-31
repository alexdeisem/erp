<?php declare(strict_types=1);

namespace App\Service\User;

use App\DTO\User\CreateUserDTO;
use App\Entity\User\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function createUser(CreateUserDTO $userDTO): User
    {
        $user = new User();
        $user->setFirstName($userDTO->firstName);
        $user->setLastName($userDTO->lastName);
        $user->setLogin($userDTO->login);
        $user->setEmail($userDTO->email);
        $user->setRoles($userDTO->roles);

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $userDTO->password
        );

        $user->setPassword($hashedPassword);

        $this->userRepository->add($user);

        return $user;
    }
}
