<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\User;

class UserRepository extends EntityRepository
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
     * @param User|NULL $user
     * @return bool|mixed
     */
    public function saveProfile(array $data, User $user = NULL)
    {
        // sanitize data
        $data = $this->checkData($data);
        if(!$user) {
            // create new instance of entity
            $user = new User();
        }

        $this->setData($data, $user);

        // NOTE: if 'id' field blank, 'persists()' will INSERT

        try {
            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            // log info
            return FALSE;
        }

        // return the last insert id
        return $user->__get('id');
    }

    /**
     * Calls setters to assign $data to properties in $profile
     *
     * @param array $data
     * @param User $user
     * @return User $user
     */
    protected function setUserData($data, User $user)
    {
        if(!$user) {
            $user = new User();
        }

        $user->__set('userName', $data['userName']);
        $user->__set('firstName', $data['firstName']);
        $user->__set('lastName', $data['lastName']);
        $user->__set('email', $data['email']);
        $user->__set('password', $data['password']);
        $user->__set('balance', $data['balance']);
        $user->__set('accessLevel', $data['accessLevel']);
        $user->__set('status', $data['status']);
        $user->__set('created', $data['created']);
        $user->__set('modified', $data['modified']);
        $user->__set('loggedOn', $data['loggedOn']);
        $user->__set('loggedOff', $data['loggedOff']);
        $user->__set('token', $data['token']);
        $user->__set('countryId', $data['countryId']);
        $user->__set('companyId', $data['companyId']);

        return $user;
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
        if(!isset($data['userName']))       { $data['userName'] = ''; }
        if(!isset($data['firstName']))      { $data['firstName'] = ''; }
        if(!isset($data['lastName']))       { $data['lastName'] = ''; }
        if(!isset($data['email']))          { $data['email'] = ''; }
        if(!isset($data['password']))       { $data['password'] = ''; }
        if(!isset($data['balance']))        { $data['balance'] = ''; }
        if(!isset($data['accessLevel']))    { $data['accessLevel'] = ''; }
        if(!isset($data['status']))         { $data['status'] = ''; }
        if(!isset($data['created']))        { $data['created'] = ''; }
        if(!isset($data['modified']))       { $data['modified'] = ''; }
        if(!isset($data['loggedOn']))       { $data['loggedOn'] = ''; }
        if(!isset($data['loggedOff']))      { $data['loggedOff'] = ''; }
        if(!isset($data['token']))          { $data['token'] = ''; }
        if(!isset($data['countryId']))      { $data['countryId'] = ''; }
        if(!isset($data['companyId']))      { $data['companyId'] = ''; }

        return $data;
    }
}