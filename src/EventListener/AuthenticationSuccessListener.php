<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use  App\Entity\User;
class AuthenticationSuccessListener{

/**
 * @param AuthenticationSuccessEvent $event
 */
public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
{
    $data = $event->getData();
    $user = $event->getUser();
    //print_r($event);
    if (!$user instanceof User) {
        return;
    }
//DODAWANIE CUSTOMOWYCH DANYCH
   $data['data'] = array(
        'user' => $user->getUsername(),
    );

    $event->setData($data);
}
}