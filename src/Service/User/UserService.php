<?php declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class UserService implements UserServiceInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(Request $request): User
    {
        $userData = $request->toArray();

        $user = new User();
        $user->setFirstName($userData['first_name']);
        $user->setLastName($userData['last_name']);
        $user->setLogin($userData['login']);
        $user->setPassword($userData['password']);
        $user->setEmail($userData['email']);
        $user->setRoles($userData['roles']);

        $this->userRepository->add($user);

        return $user;
    }
}
