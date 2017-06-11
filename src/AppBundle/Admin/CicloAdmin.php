<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Ciclo;
use AppBundle\Repository\CicloRepository;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CicloAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('plan')
            ->add('familia')
            ->add('grado', 'doctrine_orm_choice', array(
                'query_builder' => function (CicloRepository $cicloRepository)
                {
                    return $cicloRepository->findDistintColumn("grado");
                },
            ))


        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('grado')
            ->addIdentifier('name')
            ->add('familia')
            ->add('plan')

            ->add('_action', null, array(
                'actions' => array(
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('description')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('description')
        ;
    }


    public function toString($object)
    {
        return $object instanceof Ciclo
            ? $object->getName()
            : 'Ciclo'; // shown in the breadcrumb on the create view
    }


}
