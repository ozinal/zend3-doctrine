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
use Application\Repository\CompanyRepository;
use Application\Service\CompanyService;
use Doctrine\ORM\Mapping\ClassMetadata;

class CompanyController extends AbstractActionController
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    protected $companyRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        if(null === $this->entityManager) {
            $this->entityManager = $entityManager;
        }

        // use the repository to find by primary key ($id)
        if(null === $this->companyRepository) {
            $this->companyRepository = new CompanyRepository($this->entityManager, new ClassMetadata('Application\Entity\Company'));
        }
    }

    public function indexAction()
    {
        // NOTE: find one specific occurrence
        $companyOne = $this->companyRepository->findOneBy(['companyName' => 'American limos']);

        // new data (simulates form posting)
        $data = [
            'companyName'   => 'American Limos',
            'address1'      => 15
        ];

        $id = $this->companyRepository->save($data, $companyOne);

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

    public function deleteAction()
    {
        $company = $this->companyRepository->findOneBy(['companyName' => 'American limos']);
        if($company)
        {
            $service = new CompanyService();
            try {
                $this->entityManager->remove($company);
                $this->entityManager->flush();
            } catch (\Exception $e) {
                //log info
                throw new \Exception('Issue occurred', $e->getMessage());
            }
        }
        return new JsonResponse([]);
    }

    public function addAction()
    {
        $data = [
            'ip'            => $_SERVER['REMOTE_ADDR'],
            'companyName'   => 'Command Software Services Ltd',
            'postCode'      => 'WC1',
            'status'        => 0,
            'countryId'     => 0
        ];

        // 'persist' new company and returns last insert ID
        $id = $this->companyRepository->save($data);

        // use last insert ID to lookup new company
        if($id) {
            $company = $this->companyRepository->find($id);
            if($company) {
                // successful
            } else {
                // No record found
            }
        }

        return new JsonResponse([]);
    }
}