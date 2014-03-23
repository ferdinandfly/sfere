<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/16/14
 * Time: 9:11 AM
 */

namespace Ardetem\SfereBundle\Admin;
use Ardetem\SfereBundle\Lib\GlobalParameter;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class ProductAdmin extends  Admin{
    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('slug')
            ->add('description')
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
            ->add('slug', null, array('required' => true))
            ->add('translations','a2lix_translations',array(
                'fields' => array(
                    'document' =>array(
                        'field_type' => 'entity',
                        'class' => 'Ardetem\SfereBundle\Entity\Document',
                    )
                )
            ))

            ->add('subCategory','sonata_type_model',array('required' => false))
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
            ->addIdentifier('slug')
            ->add('name')
            ->add('description')
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
            ->add('name','doctrine_orm_string')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        $this->preUpdate($object);
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
        $locale=GlobalParameter::getLocale();
        $object->translate($locale)->setName($object->getName());
        $object->translate($locale)->setDescription($object->getDescription());
        $object->mergeNewTranslations();
    }
} 