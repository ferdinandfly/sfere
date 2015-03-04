<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 5/13/14
 * Time: 8:43 PM
 */

namespace Ardetem\SfereBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('companyName','text')
            ->add('activity','text',
                array(
                    'required' => false
                )
            )
            ->add('mobile', 'text',
                array(
                    'required' => false
                )
            )
            ->add('companyAddress','text',
                array(
                    'required' => false
                )
            )
            ->add('postCode','text',
                array(
                    'required' => false
                )
            )
            ->add('city','text',
                array(
                    'required' => false
                )
            )
            ->add('country','country',
                array(
                    'required' => false
                )
            )
            ->add('url','text',
                array(
                    'required' => false
                )
            )
            ->add('receiveMail','choice',array(
                'expanded' => true,
                'choices' => array('1' => 'form.yes','0' => 'form.no')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ardetem\SfereBundle\Entity\Profile',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'company_profile';
    }
} 