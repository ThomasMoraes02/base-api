<?php 
namespace App\Infraestructure\Auth;

interface TokenManager
{
    public function encode(array $input): array;

    public function decode(string $token): bool;
}