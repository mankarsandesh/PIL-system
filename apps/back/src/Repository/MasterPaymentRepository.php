<?php

namespace App\Repository;

use App\Entity\MasterPayment;
use App\Entity\User;
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
}
