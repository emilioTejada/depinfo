<?php

namespace AppBundle\Admin;

use AppBundle\Entity\TituloFP;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class Titulo_fpAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('year')
            ->add('description')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('year')
            ->add('description')
            ->add('ciclo.name')
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
            ->add('year')
            ->add('description', null, array(
                'required' => false
            ))
            ->add('ciclo', 'sonata_type_model_list', array(
                'by_reference' => false,
                'class' => 'AppBundle\Entity\Ciclo',
                'btn_add'       => 'Add ciclo',      //Specify a custom label

            ), array(
                'placeholder' => 'Ningún ciclo seleccionado'
            ))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('ciclo.name')
            ->add('ciclo.familia')
            ->add('descripcion')
            ->add('year')
        ;
    }


    public function toString($object)
    {
        return $object instanceof TituloFP
            ? $object->getId()
            : 'TituloFP'; // shown in the breadcrumb on the create view
    }
}
