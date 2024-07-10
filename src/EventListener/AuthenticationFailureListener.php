<?php

namespace App\EventListener;

use App\Exception\AuthException;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationFailureListener
{
    public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event)
    {
        throw new AuthException('Bad credentials, please verify that your username/password are correctly set', Response::HTTP_UNAUTHORIZED);
    }
    public function onJWTInvalid(JWTInvalidEvent $event)
    {
        throw new AuthException('Your token is invalid, please login again to get a new one', Response::HTTP_FORBIDDEN);
    }

    public function onJWTNotFound(JWTNotFoundEvent $event)
    {
        throw new AuthException('Missing token', Response::HTTP_FORBIDDEN);
    }

    public function onJWTExpired(JWTExpiredEvent $event)
    {
        throw new AuthException('Your token is expired, please renew it', Response::HTTP_UNAUTHORIZED);
    }
}