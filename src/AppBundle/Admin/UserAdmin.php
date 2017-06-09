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
use UserControlBundle\Entity\User;


class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Personal Data')
                ->with('Personal Data', array('class' => 'col-md-6'))
                    ->add('name', 'text')
                    ->add('surname', 'text')
                    ->add('username', 'text')
                    ->add('password', 'text')
                    ->add('email', 'email')
               ->end()
            ->end()
            ->tab('Configuration')
                ->with('Configuration', array('class' => 'col-md-6'))
                    ->add('information', null, array('required' => false))
                    ->add('rol', 'sonata_type_model', array(
                        'class' => 'UserControlBundle\Entity\Rol',
                        'property' => 'name',
                    ))
                    ->add('enable', 'checkbox', array('required' => false))
                ->end()
            ->end()
            ->tab('Contributions')
                ->with('Contributions', array('class' => 'col-md-6'))
                    ->add('mensaje', 'sonata_type_collection', array(
                            'by_reference' => false,
                            'required' => false), array(
                            'edit' => 'inline',
                            'inline' => 'table'
                        ))
                ->end()
            ->end()
            ->tab('News')
                ->with('News', array(
                    'class' => 'col-md-6',
                    'box_class'   => 'box box-solid box-success',
                    'description' => 'Noticias creadas por el usuario',
                ))
                    ->add('noticia', 'sonata_type_collection', array(
                        'by_reference' => false,
                        'required' => false), array(
                            'edit' => 'inline',
                            'inline' => 'table',
                            )
                    )
                ->end()
            ->end()
            ->tab('Currículum')
                ->with('Currículum', array(
                    'class' => 'col-md-6',
                    'box_class'   => 'box box-solid box-success',
                    'description' => 'Currículum del alumno',
                ))
                ->add('curriculum', 'sonata_type_admin', array(
//                    'class' => 'AppBundle\Entity\Curriculum',
//                    'by_reference' => false,
                    'required' => false), array(
                        'edit' => 'inline',
                        'inline' => 'table',

                    )
                )
                ->end()
            ->end()
        ;
    }





    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('username')
        ->add('name')
        ->add('surname')
        ->add('enable')
        ->add('rol.name')
        ;
    }

    public function toString($object)
    {
        return $object instanceof User
            ? $object->getName()
            : 'User'; // shown in the breadcrumb on the create view
    }

}