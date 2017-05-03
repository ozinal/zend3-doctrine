<?php
namespace Application\Controller;

use Interop\Container\ContainerInterface;

class CompanyControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new CompanyController($container->get('doctrine.entitymanager.orm_default'));
    }
}