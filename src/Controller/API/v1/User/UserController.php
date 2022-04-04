<?php declare(strict_types=1);

namespace App\Controller\API\v1\User;

use App\Controller\API\v1\BaseController;
use App\DTO\User\CreateUserDTO;
use App\Serializer\UserSerializer;
use App\Service\User\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends BaseController
{
    public function __construct(
        private UserService        $userService,
        private ValidatorInterface $validator,
        private UserSerializer     $serializer,
    ) {}

    #[Route(path: 'api/v1/user', methods: ['POST'])]
    public function store(Request $request): Response
    {
        $createUserDTO = $this->serializer->deserialize($request->toArray(), CreateUserDTO::class, 'array');
        $errors = $this->validator->validate($createUserDTO);

        if (count($errors)) {
            return $this->json($errors, 422);
        }

        $user = $this->userService->createUser($createUserDTO);

        return $this->jsonResponse($this->serializer->serialize($user, 'json'), 201);
    }
}
