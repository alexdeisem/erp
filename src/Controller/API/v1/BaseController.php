<?php declare(strict_types=1);

namespace App\Controller\API\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    protected function jsonResponse(string $json, int $status = 200, array $headers = ['Content-Type' => 'application/json']): Response
    {
        return new Response($json, $status, $headers);
    }
}
