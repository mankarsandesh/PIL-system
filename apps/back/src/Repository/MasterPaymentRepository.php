<?php

namespace App\Repository;

use App\Entity\MasterPayment;
use App\Dto\Request\User\PaymentUserDto;
use Ramsey\Uuid\Uuid;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MasterPayment>
 *
 * @method MasterPayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method MasterPayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method MasterPayment[]    findAll()
 * @method MasterPayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MasterPaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MasterPayment::class);
    }

    public function paymentLink(PaymentUserDto $payment): MasterPayment
    {
        return new MasterPayment((string) Uuid::uuid4(), $payment->getPaymentLabel(), $payment->getDescription(), $payment->getLocalization(), $payment->getGpsLocation(),  new \DateTime());
    }


    //    /**
    //     * @return MasterPayment[] Returns an array of MasterPayment objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MasterPayment
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
