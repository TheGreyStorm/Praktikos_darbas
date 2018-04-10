<?php
/**
 * Created by PhpStorm.
 * User: giedrius.l
 * Date: 4/9/2018
 * Time: 4:17 PM
 */

namespace AppBundle\Listener;


use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AuthenticationSkipperSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
          FOSUserEvents::REGISTRATION_CONFIRMED => ['stopEvent', 9999],
            FOSUserEvents::REGISTRATION_COMPLETED => ['stopEvent', 9999]
        );
    }

    public function stopEvent(FilterUserResponseEvent $event)
    {
        $event->stopPropagation();
    }
}