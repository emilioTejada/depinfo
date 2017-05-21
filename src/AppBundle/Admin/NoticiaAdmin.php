<?php
/**
 * Created by IntelliJ IDEA.
 * User: develop
 * Date: 6/05/17
 * Time: 17:34
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Noticia;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;


class NoticiaAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user', 'entity', array(
                'class' => 'UserControlBundle\Entity\User',
                'property' => 'username',
                'attr'=>array("hidden" => true)
            ))
            ->add('name', 'text')
            ->add('description', 'textarea')
            ->add('categoria', 'entity', array(
                'class' => 'AppBundle\Entity\Categoria',
                'property' => 'name',
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('user.username');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('name')
        ->add('user.username')
        ->add('categoria.name')
        ->add('date');
    }



    public function toString($object)
    {
        return $object instanceof Noticia
            ? $object->getName()
            : 'Noticia'; // shown in the breadcrumb on the create view
    }
}