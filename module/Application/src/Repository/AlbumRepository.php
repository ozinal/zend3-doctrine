<?php
/**
 * Created by PhpStorm.
 * User: ozinal
 * Date: 14/04/17
 * Time: 19:29
 */
namespace Application\Repository;

use Application\Entity\Album;
use Doctrine\ORM\EntityRepository;

class AlbumRepository extends EntityRepository
{
    // this is where you can add 'persist' and other specialized methods{
    public function findById($id)
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * "persists" data
     * Data is assumed to be in the form of an array with the following fields:
     * album, title
     * @param array $data
     * @param Album|NULL $album
     * @return bool
     */
    public function save(array $data, Album $album = NULL)
    {
        // sanitize data
        $data = $this->checkData($data);

        if(!$album) {
            // create new instance of entity
            $album = new Album();
        }

        $this->setData($data, $album);

        //NOTE: if "id" field blank, "persist()" will INSERT

        try {
            $this->getEntityManager()->persist($album);
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            // log info
            return FALSE;
        }
        // return the last insert id
        return $album->__get('id');
    }

    protected function setData($data, Album $album)
    {
        $album->__set('title', $data['title']);
        $album->__set('album', $data['album']);
    }

    /**
     * Checks to see if any array params are not set
     * Data is assumed to be in the form of an array with the following fields:
     * album, title
     * @param array $data
     * @return array $data sanitized
     */
    protected function checkData(array $data)
    {
        if(!isset($data['album'])) { $data['album'] = ''; }
        if(!isset($data['title'])) { $data['title'] = ''; }
        return $data;
    }
}