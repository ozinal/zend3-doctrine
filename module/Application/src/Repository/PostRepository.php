<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Post;

class PostRepository extends EntityRepository
{
    public function findById($id)
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * 'persists' data
     * Data is assumed to be in the form of an array with the following fields:
     * userName, firstName, lastName, email, password, balance, accessLevel, status, created, modified, loggedOn, loggedOff, token, countryId, companyId
     *
     * @param array $data
     * @param Post|NULL $user
     * @return bool|mixed
     */
    public function save(array $data, Post $post = NULL)
    {
        // sanitize data
        $data = $this->checkData($data);
        if(!$post) {
            // create new instance of entity
            $post = new Post();
        }

        $this->setData($data, $post);

        // NOTE: if 'id' field blank, 'persists()' will INSERT

        try {
            $this->getEntityManager()->persist($post);
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            // log info
            return FALSE;
        }

        // return the last insert id
        return $post->__get('id');
    }

    /**
     * Calls setters to assign $data to properties in $profile
     *
     * @param array $data
     * @param Post $post
     * @return Post $user
     * @internal param Post $user
     */
    protected function setData($data, Post $post)
    {
        if(!$post) {
            $post = new Post();
        }

        $post->__set('title', $data['title']);
        $post->__set('description', $data['description']);
        $post->__set('productId', $data['productId']);
        $post->__set('categoryId', $data['categoryId']);
        $post->__set('userId', $data['userId']);
        $post->__set('dateTime', $data['dateTime']);

        return $post;
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
        if(!isset($data['productId']))   { $data['productId'] = ''; }
        if(!isset($data['categoryId']))  { $data['categoryId'] = ''; }
        if(!isset($data['userId']))      { $data['userId'] = ''; }
        if(!isset($data['dateTime']))    { $data['dateTime'] = ''; }

        return $data;
    }
}