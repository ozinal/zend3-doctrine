<?php
/**
 * Created by PhpStorm.
 * User: ozinal
 * Date: 18/04/17
 * Time: 00:01
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class ProductController extends AbstractActionController
{
    protected $entityManager;

    protected $productRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        if(null === $this->entityManager) {
            $this->entityManager = $entityManager;
        }

        if(null === $this->productRepository)
        {
            //TODO: implement product repo
        }
    }

    public function indexAction()
    {
        //TODO: implement ProductService
        return new JsonResponse([
            'productData'   => null
        ]);
    }
}
