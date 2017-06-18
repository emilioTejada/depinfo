<?php

namespace UserControlBundle\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use UserControlBundle\Entity\User;


class UserRepository extends EntityRepository
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(User::class));
    }


    public function findByRol($rol)
    {
        return $this->createQueryBuilder('u')
            ->addselect('user_rol')
            ->join('u.rol','user_rol')
            ->Where('user_rol.name = :rol')
            ->setParameter('rol', $rol
            );
        ;
    }
}
