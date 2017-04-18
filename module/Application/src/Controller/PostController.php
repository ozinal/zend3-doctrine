<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

//use Application\Entity\Post;
//use Application\Repository\PostRepository;

class PostController extends AbstractActionController
{
    protected $entityManager;

    protected $postRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        if(null === $this->entityManager) {
            $this->entityManager = $entityManager;
        }
    }

    public function indexAction()
    {
        // TODO: implement entity and repos
    }
}