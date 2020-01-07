<?php 
namespace App\EventListener;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use FOS\UserBundle\Model\UserManagerInterface;

class JWTCreatedListener extends AbstractController{
/**
 * @var RequestStack
 */
private $requestStack;
private $userManager;

/**
 * @param RequestStack $requestStack
 * @param UserManagerInterface $userManager
 */
public function __construct(RequestStack $requestStack ,UserManagerInterface $userManager)
{
    $this->requestStack = $requestStack;
    $this->userManager = $userManager;
}

/**
 * @param JWTCreatedEvent $event
 * 
 * @return void
 */
public function onJWTCreated(JWTCreatedEvent $event)
{
    $request = $this->requestStack->getCurrentRequest();
    
   // $container = $this->getContainer();
   // $userManager = $this->container->get('fos_user.user_manager');
   
  
    $payload       = $event->getData();
    //print_r($payload);
    $user = $this->userManager->findUserByUsername($payload['username']);
    //print_r($user);
    $payload['name'] = $user->getName();
    $payload['surname'] = $user->getSurname();
    //$payload['ip'] = $request->getClientIp();

    $event->setData($payload);
    
    $header        = $event->getHeader();
    $header['cty'] = 'JWT';

    $event->setHeader($header);
}
}


?>