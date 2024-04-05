<?php 
namespace App\Infraestructure\Auth;

use DateTime;
use Exception;
use Throwable;
use DateTimeZone;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Infraestructure\Auth\TokenManager;
use stdClass;

class TokenFirebaseJWT implements TokenManager
{
    public function encode(array $input): array
    {
        $days = '+'.$_ENV['AUTH_EXPIRATION_TOKEN'].' days';
        $exp = (new DateTime('now', new DateTimeZone('America/Sao_Paulo')))->modify($days)->getTimestamp();

        $payload = [
            'iss' => '',
            'exp' => $exp,
            'name' => $_ENV['APP_NAME'],
            'role' => 'admin'
        ];

        $accessToken = JWT::encode($payload, $_ENV['AUTH_SECRET_KEY'], $_ENV['AUTH_ALGORITHM']);

        return [
            'access_token' => $accessToken,
            'expires_in' => $exp,
            'token_type' => 'Bearer'
        ];
    }

    public function decode(string $token): bool
    {
        $token = str_replace('Bearer ', '',trim($token));
        $decoded = $this->decodedToken($token);
        if($this->tokenExpired($decoded)) throw new Exception("Expired token");
        if(!isset($decoded->name) || $decoded->name !== $_ENV['APP_NAME']) throw new Exception("Invalid Token");
        return true;
    }

    private function decodedToken(string $token): stdClass
    {
        try {
            $key = new Key($_ENV['AUTH_SECRET_KEY'],$_ENV['AUTH_ALGORITHM']);
            return JWT::decode($token,$key);
        } catch(Throwable $e) {
            throw new Exception("Invalid Token");
        }
    }

    private function tokenExpired(stdClass $token): bool
    {
        $timeZone = new DateTimeZone('America/Sao_Paulo');
        $now = new DateTime('now', $timeZone);
        $expires = new DateTime(date('Y-m-d h:i:s',$token->exp),$timeZone);
        return $now->diff($expires)->invert == 1;
    }
}