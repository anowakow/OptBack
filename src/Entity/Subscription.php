<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Subject;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubscriptionRepository")
 * @ORM\Table(name="Subscription")
 */
class Subscription 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;    
    
    /** 
     *  @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;
    
     /** 
     * @ORM\ManyToOne(targetEntity="Subject")
     */
    protected $subject;

    /** @ORM\Column(type="datetime", name="subscriptionFrom") */
    protected $subscriptionFrom;

    /** @ORM\Column(type="datetime", name="subscriptionTo") */
    protected $subscriptionTo;

    /*
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
*/
    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getSubscriptionFrom()
    {
        return $this->subscriptionFrom;
    }

    public function setSubscriptionFrom($subscriptionFrom)
    {
        $this->subscriptionFrom = $subscriptionFrom;
    }
    public function getSubscriptionTo()
    {
        return $this->subscriptionTo;
    }

    public function setSubscriptionTo($subscriptionFrom)
    {
        $this->subscriptionFrom = $subscriptionFrom;
    }
}