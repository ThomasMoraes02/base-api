<?php 

use App\Application\UseCases\Auth\CreateToken;
use App\Infraestructure\Auth\TokenFirebaseJWT;

test("Deve criar um token pelo caso de uso", function() {
    $useCase = new CreateToken(new TokenFirebaseJWT());
    $output = $useCase->execute();
    expect($output)->toHaveKey('access_token');
    expect($output)->toHaveKey('expires_in');
    expect($output)->toHaveKey('token_type');
});