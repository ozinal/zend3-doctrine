<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Application\Repository\ProductRepository;

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
            $this->productRepository = new ProductRepository($this->entityManager, new ClassMetadata('Application\Entity\Product'));
        }
    }

    /**
     * One to Many doctrine relation
     * @return JsonResponse
     */
    public function indexAction()
    {
        $product = $this->productRepository->findById(1);
        if($product) {
            //echo $product->getTitle() . '</br>';

            foreach ($product->getPosts() as $post) {
                //echo $post->getTitle() .'</br >';
            }
        }
        return new JsonResponse([
            'productData'   => null
        ]);
    }
}
