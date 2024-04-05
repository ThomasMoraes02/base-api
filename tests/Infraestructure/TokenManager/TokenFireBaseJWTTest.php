<?php 
namespace Tests\Infraestructure\TokenManager;

use App\Infraestructure\Auth\TokenFirebaseJWT;
use App\Infraestructure\Auth\TokenManager;
use PHPUnit\Framework\TestCase;

class TokenFireBaseJWTTest extends TestCase
{
    private readonly TokenManager $tokenManager;

    protected function setUp(): void
    {
        $this->tokenManager = new TokenFirebaseJWT();
    }

    public function test_deve_criar_um_token()
    {
        $token = $this->tokenManager->encode([]);
        $this->assertIsString($token['access_token']);
    }

    public function test_deve_decodificar_um_token()
    {
        $token = $this->tokenManager->encode([]);
        $decode = $this->tokenManager->decode($token['access_token']);
        $this->assertTrue($decode);
    }
}