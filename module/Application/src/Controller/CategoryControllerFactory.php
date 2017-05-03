<?php
namespace Application\Controller;

use Interop\Container\ContainerInterface;

class CategoryControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new CategoryController($container->get('doctrine.entitymanager.orm_default'));
    }
}