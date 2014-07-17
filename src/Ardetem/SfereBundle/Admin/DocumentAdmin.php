<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/16/14
 * Time: 10:11 AM
 */

namespace Ardetem\SfereBundle\Admin;

use Ardetem\SfereBundle\Lib\GlobalParameter;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class DocumentAdmin extends  Admin{
    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('path')
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
            ->add('file', 'file', array('required' => false))
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
            ->addIdentifier('path')
            ->add('createdAt')
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
            ->add('path')
            ->add('createdAt')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($doc)
    {
        $doc->setCreatedAt(new \DateTime());
        $this->preUpdate($doc);
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($doc)
    {
        $this->manageFileUpload($doc);
    }

    private function manageFileUpload($doc) {
        if ($doc->getFile()) {
            $doc->setUpdatedAt(new \DateTime());
        }
    }
} 