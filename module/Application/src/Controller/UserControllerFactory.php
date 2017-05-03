<?php
namespace Application\Controller;

use Interop\Container\ContainerInterface;

class UserControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new UserController($container->get('doctrine.entitymanager.orm_default'));
    }
}