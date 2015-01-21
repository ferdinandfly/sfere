<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/1/21 0021
 * Time: 下午 10:35
 */

namespace Ardetem\SfereBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateTransCommand extends ContainerAwareCommand{

    protected function configure()
    {
        $this->setName('sfere:generateTrans')
            ->setDescription('Generate empty translation record.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container= $this->getContainer();
        $locals = $container->getParameter('a2lix_translation_form.locales');
        $em= $container->get('doctrine')->getManager();
        $connection = $em->getConnection();

        $sql = "SELECT id FROM product";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $em->clear();
        $newProducts = array();
        foreach($products as $product){
            $newProducts[$product['id']] = $product['id'];
        }
        foreach($locals as $local){
            $sql = "SELECT p.id FROM product p INNER JOIN product_trans pt ON p.id = pt.translatable_id WHERE pt.locale = '$local'";
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $localProducts = $stmt->fetchAll();
            $products = $newProducts ;
            foreach ($localProducts as $product){
                unset($products[$product['id']]);
            }
            $connection->beginTransaction();
            foreach($products as $id){
                $connection->exec("insert into product_trans (translatable_id, locale) values ($id, '$local')");
            }
            $connection->commit();
            $em->clear();
        }
        echo "finished";
    }
}