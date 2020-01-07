<?php
namespace App\DTO;
use App\DTO\Ser;
use App\Entity\Subscription;

class SubscriptionDTO{

    
    protected $id;    
    protected $user;
    protected $subject;
    protected $subscriptionFrom;
    protected $subscriptionTo;

    public function __construct(Subscription $subscription)
    {
       $this->id = $subscription->getId();
       $user = new Ser($subscription->user->getId(), $subscription->user->getUsername());
       $subject = new Ser($subscription->subject->getId(), $subscription->subject->getName());
       $this->user=$user;
       $this->subject=$subject;
       $this->subscriptionFrom=$this->subscriptionFrom;
       $this->subscriptionTo=$this->subscriptionTo;
    }
    
}


?>