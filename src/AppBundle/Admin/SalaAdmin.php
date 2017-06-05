<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Sala;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use UserControlBundle\Entity\User;
use UserControlBundle\Repository\UserRepository;

class SalaAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('description')
            ->add('year')
            ->add('sala_tipo', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\Sala_tipo',
                'choice_label' => 'name', //
            ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('description')
            ->add('year')
            ->add('_action', null, array(
                'actions' => array(
//                    'show' => array(),
//                    'edit' => array(),
//                    'delete' => array(),
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
            ->add('title')
            ->add('asignatura', 'sonata_type_model_list', array(
                'class' => 'AppBundle\Entity\Asignatura',
                'btn_add' => false,
                'btn_delete' => false,
                'required' => false
            ))
            ->add('description')
            ->add('sala_tipo', 'entity', array(
                'class' => 'AppBundle\Entity\Sala_tipo',
                'property' => 'name',
            ))
            ->add('year')

            ->add('author', 'entity', array(
                'class' => 'UserControlBundle\Entity\User',
                'property' => 'name',
                'query_builder' => function (UserRepository $userRepository)
                {
                    return $userRepository->findByRol("Admin");
                },
            ))
            ->add('users', 'entity', array(
                'class' => 'UserControlBundle\Entity\User',
                'by_reference' => false,
                'property' => 'name',
                'multiple' => true,
                'expanded' =>true,
                'query_builder' => function (UserRepository $userRepository)
                {
                    return $userRepository->findByRol("Alumno");
                },

            ))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('description')
            ->add('year')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Sala
            ? $object->getTitle()
            : 'Sala'; // shown in the breadcrumb on the create view
    }

    public function getNewInstance()
    {
        $instance = parent::getNewInstance();
        $instance->setYear(date("Y"));

        return $instance;
    }

}
