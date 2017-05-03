<?php
namespace Application\Controller;

use Application\Service\UserService;
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
            $this->userRepository = new UserRepository($this->entityManager, new ClassMetadata('Application\Entity\User'));
        }
    }

    public function indexAction()
    {
        // NOTE: find one specific occurrence
        $user  = $this->entityManager->find('Application\Entity\User', 27);
        if($user)
        {
            $service    = new UserService();
            $userData   = $service->showUser($user);
        }

        return new JsonResponse([
            'userData' => $user
        ]);
    }

    public function editAction()
    {
        $user = $this->userRepository->findById(2);
        var_dump($user->getCountryId()->getText());

        return new ViewModel([

        ]);
    }

    public function manyToOneAction()
    {
        $user = $this->userRepository->findById(2);

        foreach ($user->getPosts() as $post) {
            print_r($post) . '<br />';
        }

        exit();
    }
}