<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Product;

class ProductRepository extends EntityRepository
{
    public function findById($id)
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * 'persists' data
     * Data is assumed to be in the form of an array with the following fields:
     * sku, title, description, dateTime, categoryId
     *
     * @param array $data
     * @param Product |NULL $product
     * @return bool|mixed
     */
    public function save(array $data, Product $product = NULL)
    {
        // sanitize data
        $data = $this->checkData($data);
        if(!$product) {
            // create new instance of entity
            $product = new Product();
        }

        $this->setData($data, $product);

        // NOTE: if 'id' field blank, 'persists()' will INSERT

        try {
            $this->getEntityManager()->persist($product);
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            // log info
            return FALSE;
        }

        // return the last insert id
        return $product->__get('id');
    }

    /**
     * Calls setters to assign $data to properties in $profile
     *
     * @param array $data
     * @param Product $product
     * @return Product $product
     * @internal param Product $pro
     */
    protected function setData($data, Product $product)
    {
        if(!$product) {
            $product = new Product();
        }

        $product->__set('id', $data['id']);
        $product->__set('sku', $data['sku']);
        $product->__set('title', $data['title']);
        $product->__set('description', $data['description']);
        $product->__set('dateTime', $data['dateTime']);
        $product->__set('categoryId', $data['categoryId']);

        return $product;
    }

    /**
     * Checks to see if any array params are not set
     * Data is assumed to be in the form of an array with the following fields:
     * userName, firstName, lastName, email, password, balance, accessLevel, status, created, modified, loggedOn, loggedOff, token, countryId, companyId
     *
     * @param array $data
     * @return array
     */
    protected function checkData(array $data)
    {
        if(!isset($data['sku']))         { $data['sku'] = ''; }
        if(!isset($data['title']))       { $data['title'] = ''; }
        if(!isset($data['description'])) { $data['description'] = ''; }
        if(!isset($data['dateTime']))    { $data['dateTime'] = ''; }
        if(!isset($data['categoryId']))  { $data['categoryId'] = ''; }

        return $data;
    }
}