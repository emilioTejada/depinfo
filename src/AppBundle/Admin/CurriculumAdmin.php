<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Curriculum;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;
use Sonata\AdminBundle\Show\ShowMapper;

class CurriculumAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('currentcourse')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('user.name')
            ->add('user.surname')
            ->add('user.username')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Curso actual', array(
                'class' => 'col-md-6',
                'box_class'   => 'box box-solid box-success',
                'description' => 'Currículum del alumno',
            ))
            ->add('currentcourse', 'choice', array(
                'choices' => array(
                    1 => 'primero',
                    2 => 'segundo',
                )
            ))
            ->add('currentCiclo', 'sonata_type_model_list', array(
                'by_reference' => false,
                'required' => false,
                'class' => 'AppBundle\Entity\Ciclo',
                'btn_add'       => 'Add ciclo',      //Specify a custom label

            ), array(
                'placeholder' => 'Ningún ciclo seleccionado'
            ))
            ->end()
            ->add('tituloFp', 'sonata_type_collection', array(
                'by_reference' => false,
                'required' => false), array(
                'edit' => 'inline',
                'inline' => 'table'
            ));
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('currentcourse')
            ->add('currentCiclo.name')
//            ->add('tituloFp')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Curriculum
            ? $object->getId()
            : 'Curriculum'; // shown in the breadcrumb on the create view
    }


}
