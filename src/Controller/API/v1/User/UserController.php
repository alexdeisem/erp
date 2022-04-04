<?php declare(strict_types=1);

namespace App\Controller\API\v1\User;

use App\DTO\User\CreateUserDTO;
use App\Serializer\UserDenormalizer;
use App\Service\User\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    public function __construct(
        private UserService        $userService,
        private ValidatorInterface $validator,
        private UserDenormalizer   $userDenormalizer,
    ) {}

    #[Route(path: 'api/v1/user', methods: ['POST'])]
    public function store(Request $request): Response
    {
        $createUserDTO = $this->userDenormalizer->denormalize($request->toArray(), CreateUserDTO::class);
        $errors = $this->validator->validate($createUserDTO);

        if (count($errors)) {
            return $this->json($errors, 422);
        }

        $user = $this->userService->createUser($createUserDTO);

        return $this->json([], 201);
    }
}
