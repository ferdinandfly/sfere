<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 5/13/14
 * Time: 9:01 PM
 */

namespace Ardetem\SfereBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProfileAdmin extends Admin{

    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('companyName')
            ->add('companyAddress')
            ->add('postCode')
            ->add('city')
            ->add('country')
            ->add('url')
            ->add('receiveMail')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user','sonata_type_model',array('btn_add'=> false))
            ->add('companyName')
            ->add('companyAddress')
            ->add('postCode')
            ->add('city')
            ->add('country','country')
            ->add('url')
            ->add('receiveMail')
            ->end()
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('companyName')
            ->add('country','country')
            ->add('url')
            ->add('companyAddress')
            ->add('receiveMail')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('companyName','doctrine_orm_string')
            ->add('country')
        ;
    }

} 