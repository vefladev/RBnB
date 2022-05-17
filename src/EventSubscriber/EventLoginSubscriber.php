<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class EventLoginSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [AuthenticationSuccessEvent::class => 'OnAuthenticationSuccess'];
    }

    public function OnAuthenticationSuccess(AuthenticationSuccessEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        if (!$user->isVerified())
            throw new AuthenticationException("Merci de vérifier votre adresse email et valider votre compte.");
    }
}
