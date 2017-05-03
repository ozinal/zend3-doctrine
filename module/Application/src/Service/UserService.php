<?php
namespace Application\Service;

use Application\Entity\User;

class UserService
{
    public function showUserHeader()
    {

    }

    /**
     * @param User $user
     * @return array
     */
    public function showUser(User $user)
    {
        return [
            'id'            => $user->__get('id'),
            'userName'      => $user->__get('userName'),
            'firstName'     => $user->__get('firstName'),
            'lastName'      => $user->__get('lastName'),
            'email'         => $user->__get('email'),
            'password'      => $user->__get('password'),
            'balance'       => $user->__get('balance'),
            'accessLevel'   => $user->__get('accessLevel'),
            'status'        => $user->__get('status'),
            'created'       => $user->__get('created'),
            'modified'      => $user->__get('modified'),
            'loggedOn'      => $user->__get('loggedOn'),
            'loggedOff'     => $user->__get('loggedOff'),
            'token'         => $user->__get('token'),
            'countryId'     => $user->__get('countryId'),
            'companyId'     => $user->__get('companyId')
        ];
    }
}