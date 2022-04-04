<?php declare(strict_types=1);

namespace App\Service\User;

use App\DTO\User\CreateUserDTO;
use App\Entity\User\User;
use App\Factory\UserFactory;
use App\Repository\UserRepository;

class UserService implements UserServiceInterface
{
    public function __construct(
        private UserFactory $userFactory,
        private UserRepository $userRepository
    ) {}

    public function createUser(CreateUserDTO $userDTO): User
    {
        $user = $this->userFactory->create(
            $userDTO->firstName,
            $userDTO->lastName,
            $userDTO->login,
            $userDTO->password,
            $userDTO->email,
            $userDTO->roles
        );

        $this->userRepository->add($user);

        return $user;
    }
}
