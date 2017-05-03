<?php
/**
 * Created by PhpStorm.
 * User: ozinal
 * Date: 17/04/17
 * Time: 23:59
 */
namespace  Application\Controller;

use Interop\Container\ContainerInterface;

class ProductControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ProductController($container->get('doctrine.entitymanager.orm_default'));
    }
}