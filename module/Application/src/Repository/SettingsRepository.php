<?php
namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class SettingsRepository extends EntityRepository
{
    public function findById($id)
    {
        return $this->find($id);
    }
}