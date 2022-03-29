<?php declare(strict_types=1);

namespace App\Controller\API\v1\User;

use App\Service\User\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route(path: 'api/v1/user', methods: ['POST'])]
    public function store(Request $request, UserService $userService): Response
    {
        $user = $userService->createUser($request);

        return $this->json($user);
    }
}
