<?php

namespace App\EventListener;

use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class LoginVerifiedListener
{
    public function OnAuthenticationSuccess(AuthenticationSuccessEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        if (!$user->isVerified())
            throw new AuthenticationException("Merci de vérifier votre adresse email et valider votre compte.");
    }
}
