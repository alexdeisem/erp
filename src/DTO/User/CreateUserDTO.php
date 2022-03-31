<?php declare(strict_types=1);

namespace App\DTO\User;

use App\Entity\User\UserRoles;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 1, max: 50)]
    public string $firstName;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    public string $lastName;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6, max: 50)]
    public string $login;

    #[Assert\NotBlank]
    #[Assert\NotCompromisedPassword]
    #[Assert\Length(min: 8, max: 50)]
    public string $password;

    #[Assert\Email]
    #[Assert\Length(min: 8, max: 75)]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Choice(choices: UserRoles::ROLES, multiple: true)]
    public array $roles;
}
