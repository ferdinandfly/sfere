<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 4/26/14
 * Time: 9:40 PM
 */

namespace Ardetem\SfereBundle\Form\DataTransformer;

use Ardetem\SfereBundle\Entity\Document;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

class DocumentToFile implements DataTransformerInterface
{

    public function transform($doc)
    {
        return null;
    }

    public function reverseTransform($file)
    {
        if ($file != null) {
            $doc = new Document();
            $doc->setFile($file);
            return $doc;
        }
        return null;
    }
} 