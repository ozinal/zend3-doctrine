<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Zend\Diactoros\Response\JsonResponse;

use Application\Entity\User;
use Application\Repository\UserRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class UserController extends AbstractActionController
{
    protected $entityManager;

    protected $userRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        if(null === $this->entityManager) {
            $this->entityManager = $entityManager;
        }

        if(null === $this->userRepository) {
            $this->userRepository = new UserRepository($this->entityManager, new ClassMetadata('Application\Entity\Company'));
        }
    }

    public function indexAction()
    {
        return new JsonResponse([]);
    }
}