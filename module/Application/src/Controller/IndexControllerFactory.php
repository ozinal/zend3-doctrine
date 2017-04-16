<?php
/**
 * Created by PhpStorm.
 * User: ozinal
 * Date: 14/04/17
 * Time: 18:51
 */

namespace Application\Controller;

use Interop\Container\ContainerInterface;

class IndexControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new IndexController($container->get('doctrine.entitymanager.orm_default'));
    }
}