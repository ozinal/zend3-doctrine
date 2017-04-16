<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

use Application\Entity\Album;
use Application\Service\AlbumService;

use Application\Entity\Company;
use Application\Service\CompanyService;

class IndexController extends AbstractActionController
{
    /**
     * @var DoctrineORMEntityManager
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        if (null === $this->entityManager) {
            $this->entityManager = $entityManager;
        }
    }

    public function indexAction()
    {
        $album = $this->entityManager->find('Application\Entity\Album', 1);
        if($album)
        {
            $service        = new AlbumService();
            $albumData      = $service->showAlbum($album);
        }

        $company = $this->entityManager->find('Application\Entity\Company',2);
        if($company)
        {
            $service        = new CompanyService();
            $companyData    = $service->showCompany($company);
        }

        $this->entityManager->getRepository('Application\Entity\Album')->findAll();

        return new ViewModel([
            'album'     => $albumData,
            'company'   => $companyData
        ]);
    }

}