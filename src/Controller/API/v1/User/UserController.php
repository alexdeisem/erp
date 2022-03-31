<?php declare(strict_types=1);

namespace App\Controller\API\v1\User;

use App\DTO\User\CreateUserDTO;
use App\Service\User\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    private ObjectNormalizer $normalizer;

    public function __construct()
    {
        $this->normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
    }

    #[Route(path: 'api/v1/user', methods: ['POST'])]
    public function store(Request $request, ValidatorInterface $validator, UserService $userService): Response
    {
        $createUserDTO = $this->normalizer->denormalize($request->toArray(), CreateUserDTO::class);
        $errors = $validator->validate($createUserDTO);

        if (count($errors)) {
            return $this->json($errors, 422);
        }

        $user = $userService->createUser($createUserDTO);

        return $this->json([], 201);
    }
}
