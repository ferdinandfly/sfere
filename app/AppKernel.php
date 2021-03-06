<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            //...

            // If you haven't already, add the storage bundle
            // This example uses SonataDoctrineORMAdmin but
            // it works the same with the alternatives
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            // Then add SonataAdminBundle
            new Sonata\AdminBundle\SonataAdminBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),

            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            new Sonata\jQueryBundle\SonatajQueryBundle(),
            new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
            new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),
            new Ardetem\SfereBundle\ArdetemSfereBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Mopa\Bundle\BootstrapBundle\MopaBootstrapBundle(),
            //new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            new Ardetem\ImportBundle\ArdetemImportBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    protected function initializeContainer() {
        parent::initializeContainer();
        if (PHP_SAPI == 'cli') {
            $this->getContainer()->enterScope('request');
            $this->getContainer()->set('request', new \Symfony\Component\HttpFoundation\Request(), 'request');
        }
    }
}
