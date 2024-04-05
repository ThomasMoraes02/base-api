<?php 
namespace App\Application\UseCases\Auth;

use App\Infraestructure\Auth\TokenManager;

class CreateToken
{
    public function __construct(private readonly TokenManager $tokenManager) {}

    public function execute(array $input = []): array
    {
        $authentication = $this->tokenManager->encode($input);
        return [
            'access_token' => $authentication['access_token'],
            'expires_in' => $authentication['expires_in'],
            'token_type' => $authentication['token_type']
        ];
    }
}