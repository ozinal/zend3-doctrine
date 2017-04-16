<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class CompanyRepository extends EntityRepository
{
    // this is where you can add 'persist' and other specialized methods
    public function findById($id)
    {
        return $this->find($id);
    }
}