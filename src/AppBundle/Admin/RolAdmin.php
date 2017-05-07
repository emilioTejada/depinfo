<?php
/**
 * Created by IntelliJ IDEA.
 * User: develop
 * Date: 6/05/17
 * Time: 17:34
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use UserControlBundle\Entity\Rol;


class RolAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('description', null, array('required' => false));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description');
    }

    public function toString($object)
    {
        return $object instanceof Rol
            ? $object->getName()
            : 'Rol'; // shown in the breadcrumb on the create view
    }

}