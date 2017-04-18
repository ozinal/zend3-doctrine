<?php
/**
 * Created by PhpStorm.
 * User: ozinal
 * Date: 19/04/17
 * Time: 00:06
 */

namespace Application\Controller;

use Interop\Container\ContainerInterface;

class PostControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new PostController($container->get('doctrine.entitymanager.orm_default'));
    }
}