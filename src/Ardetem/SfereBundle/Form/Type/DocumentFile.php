<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 4/26/14
 * Time: 9:38 PM
 */

namespace Ardetem\SfereBundle\Form\Type;
use Ardetem\SfereBundle\Form\DataTransformer\DocumentToFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentFile extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new DocumentToFile();
        $builder->addModelTransformer($transformer);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'invalid_message' => 'Must be a file',
            'required'=>false,
        ));
    }

    public function getParent()
    {
        return 'file';
    }

    public function getName()
    {
        return 'admin_document_to_file';
    }
}