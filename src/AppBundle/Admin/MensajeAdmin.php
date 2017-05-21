<?php
/**
 * Created by IntelliJ IDEA.
 * User: develop
 * Date: 6/05/17
 * Time: 17:34
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Mensaje;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;


class MensajeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user', 'entity', array(
                'class' => 'UserControlBundle\Entity\User',
                'property' => 'username',
                'attr'=>array("hidden" => true)
            ))
            ->add('content', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('content');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->add('user.username')
        ->addIdentifier('content')
        ->add('date')
        ;
    }

    public function toString($object)
    {
        return $object instanceof Mensaje
            ? $object->getContent()
            : 'Mensaje'; // shown in the breadcrumb on the create view
    }
}