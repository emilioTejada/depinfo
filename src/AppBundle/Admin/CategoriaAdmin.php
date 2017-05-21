<?php
/**
 * Created by IntelliJ IDEA.
 * User: develop
 * Date: 6/05/17
 * Time: 17:34
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Categoria;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CategoriaAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ;
    }

    public function toString($object)
    {
        return $object instanceof Categoria
            ? $object->getName()
            : 'Categoria'; // shown in the breadcrumb on the create view
    }

}