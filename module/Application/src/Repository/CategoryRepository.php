<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Category;

class CategoryRepository extends EntityRepository
{
    public function findById($id)
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * 'persists' data
     * Data is assumed to be in the form of an array with the following fields:
     * title, description, dateTime, parentId
     *
     * @param array $data
     * @param Category|NULL $category
     * @return bool|mixed
     */
    public function save(array $data, Category $category = NULL)
    {
        // sanitize data
        $data = $this->checkData($data);
        if(!$category) {
            // create new instance of entity
            $category = new Category();
        }

        $this->setData($data, $category);

        // NOTE: if 'id' field blank, 'persists()' will INSERT

        try {
            $this->getEntityManager()->persist($category);
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            // log info
            return FALSE;
        }

        // return the last insert id
        return $category->__get('id');
    }

    /**
     * Calls setters to assign $data to properties in $profile
     *
     * @param array $data
     * @param Category $category
     * @return Category $user
     * @internal param Category $user
     */
    protected function setData($data, Category $category)
    {
        if(!$category) {
            $category = new Category();
        }

        $category->__set('title', $data['title']);
        $category->__set('description', $data['description']);
        $category->__set('dateTime', $data['dateTime']);
        $category->__set('parentId', $data['parentId']);

        return $category;
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
        if(!isset($data['title']))       { $data['title'] = ''; }
        if(!isset($data['description'])) { $data['description'] = ''; }
        if(!isset($data['dateTime']))    { $data['dateTime'] = ''; }
        if(!isset($data['parentId']))    { $data['parentId'] = ''; }

        return $data;
    }
}