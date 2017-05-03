<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

//use Application\Entity\Category;
//use Application\Repository\CategoryRepository;

class CategoryController extends AbstractActionController
{
    protected $entityManager;

    protected $categoryRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        if(null === $this->entityManager) {
            $this->entityManager = $entityManager;
        }
    }

    public function indexAction()
    {
        // TODO: entity/repos
    }
}