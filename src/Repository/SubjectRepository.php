<?php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Subject;
use App\Entity\User;


class SubjectRepository extends ServiceEntityRepository
{
   
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subject::class);
    }
   
    /**
     * @return Subscription[] Returns an array of active Subject objects
     */
    
    public function findAllActiveSubscription(User $user)
    {
        return $this->createQueryBuilder('a')
           // ->andWhere('a.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
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