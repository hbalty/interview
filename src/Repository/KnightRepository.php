<?php

namespace App\Repository;

use App\Entity\Knight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\ORMException;
use Prophecy\Exception\InvalidArgumentException;

/**
 * @method Knight|null find($id, $lockMode = null, $lockVersion = null)
 * @method Knight|null findOneBy(array $criteria, array $orderBy = null)
 * @method Knight[]    findAll()
 * @method Knight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KnightRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Knight::class);
    }

    /**
     * @param Knight $knight
     */
    public function save(Knight $knight){
        $em = $this->getEntityManager();
        try{
            $em->persist($knight);
            $em->flush();
        }catch (ORMException $ORMException){
            throw new InvalidArgumentException();
        }
    }




    public function all($offset, $limit)
    {
        return $this->createQueryBuilder('k')
            ->select('k')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Knight
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
