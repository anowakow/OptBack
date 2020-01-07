<?php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\User;
use App\Entity\Subject;
use App\Entity\Subscription;

class SubscriptionRepository extends ServiceEntityRepository
{
    
    
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subscription::class);
    }
    
    /**
     * @return Subject[] Returns an array of active Subject objects
     */
    
    public function findAllActiveSubscriptionsByUser(User $user)
    {
        return $this->createQueryBuilder('subs')
            ->andWhere('subs.user = :user')
            ->setParameter('user', $user)
            ->orderBy('subs.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Subject[] Returns an array of Article objects
     */
    
    public function findAllActiveSubjects()
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.active = true')
            ->andWhere('s.demo = false')
            //->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Subject[] Returns an array of Article objects
     */
    
    public function findAllActiveDemoSubjects()
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.active = true')
            ->andWhere('s.demo = true')
            //->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

}


?>