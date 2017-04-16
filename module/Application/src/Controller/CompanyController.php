<?php
/**
 * Created by PhpStorm.
 * User: ozinal
 * Date: 16/04/17
 * Time: 11:02
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Application\Entity\Company;
use Application\Service\CompanyService;

class CompanyController extends AbstractActionController
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        if(null === $this->entityManager) {
            $this->entityManager = $entityManager;
        }
    }

    public function indexAction()
    {
        $company = $this->entityManager->find('Application\Entity\Company',2);
        if($company)
        {
            $service        = new CompanyService();
            $companyData    = $service->showCompany($company);
        }

        return new JsonResponse([
            'company' => $companyData
        ]);
    }
}