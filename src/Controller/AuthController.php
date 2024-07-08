<?php
namespace App\Controller;

use App\DTO\Request\UserDto;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends ApiController
{

    /**
     * @param UserService $userService
     */
    public function __construct(private UserService $userService)
    {}

    public function register(UserDto $dto): JsonResponse
    {
        return $this->json($this->userService->create($dto));
    }
}