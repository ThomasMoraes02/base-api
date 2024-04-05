<?php 
namespace Tests\Application\UseCases;

use App\Application\UseCases\Auth\CreateToken;
use App\Infraestructure\Auth\TokenFirebaseJWT;
use PHPUnit\Framework\TestCase;

class CreateTokenTest extends TestCase
{
    private CreateToken $useCase;

    protected function setUp(): void
    {
        $this->useCase = new CreateToken(new TokenFirebaseJWT());
    }

    public function test_deve_criar_um_token_pelo_caso_de_uso()
    {
        $output = $this->useCase->execute();
        $this->assertIsArray($output);
        $this->assertArrayHasKey('access_token', $output);
        $this->assertArrayHasKey('expires_in', $output);
        $this->assertArrayHasKey('token_type', $output);
        $this->assertIsString($output['access_token']);
        $this->assertIsInt($output['expires_in']);
        $this->assertIsString($output['token_type']);
    }
}