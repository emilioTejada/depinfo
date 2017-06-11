<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Ciclo;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

/**
 * SalaRepository
 */
class CicloRepository extends EntityRepository
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Ciclo::class));
    }


    public function findDistintColumn($colum)
    {
        return $this->createQueryBuilder('c')
            ->select('name')
//            ->distinct('true')
            ;
        ;
    }

}
