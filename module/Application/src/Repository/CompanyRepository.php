<?php
namespace Application\Repository;

use Application\Entity\Company;
use Doctrine\ORM\EntityRepository;

class CompanyRepository extends EntityRepository
{
    // this is where you can add 'persist' and other specialized methods
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * "persists" data
     * Data is assumed to be in the form of an array with the following fields:
     * id, ip. companyName, address1, address2, address3, address4, postCode, telephone1, telephone2, webSite, status, lat, lng, countryId
     *
     * @param array $data
     * @param Application\Entity\Company $company
     * @return bool
     */
    public function save(array $data, Company $company = NULL)
    {
        // sanitize data
        $data = $this->checkData($data);
        if(!$data)
        {
            // create new instance of entity
            $company = new Company();
        }

        $this->setData($data, $company);

        // Note : if 'id' field blank, 'persist()' will INSERT

        try {
            $this->getEntityManager()->persist();
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            // log info
            return FALSE;
        }

        // return the last insert id
        return $company->__get('id');
    }

    protected function setData($data, Company $company)
    {
        $company->__set('id', $data['id']);
        $company->__set(ip, $data['ip']);
        $company->__set('companyName', $data['companyName']);
        $company->__set('address1', $data['address1']);
        $company->__set('address2', $data['address2']);
        $company->__set('address3', $data['address3']);
        $company->__set('address4', $data['address4']);
        $company->__set('postCode', $data['postCode']);
        $company->__set('telephone1', $data['telephone1']);
        $company->__set('telephone2', $data['telephone2']);
        $company->__set('webSite', $data['webSite']);
        $company->__set('status', $data['status']);
        $company->__set('lat', $data['lat']);
        $company->__set('lng', $data['lng']);
        $company->__set('countryId', $data['countryId']);
    }

    /**
     * Checks to see if any array params are not set
     * Data is assumed to be in the form of an array with the following fields
     * id, ip. companyName, address1, address2, address3, address4, postCode, telephone1, telephone2, webSite, status, lat, lng, countryId
     *
     * @param array $data
     * @return array $data sanitized
     */
    protected function checkData(array $data)
    {
        if(!isset($data['id']))             { $data['id'] = ''; }
        if(!isset($data['ip']))             { $data['ip'] = ''; }
        if(!isset($data['companyName']))    { $data['companyName'] = ''; }
        if(!isset($data['address1']))       { $data['address1'] = ''; }
        if(!isset($data['address2']))       { $data['address2'] = ''; }
        if(!isset($data['address3']))       { $data['address3'] = ''; }
        if(!isset($data['address4']))       { $data['address4'] = ''; }
        if(!isset($data['postCode']))       { $data['postCode'] = ''; }
        if(!isset($data['telephone1']))     { $data['telephone1'] = ''; }
        if(!isset($data['telephone2']))     { $data['telephone2'] = ''; }
        if(!isset($data['webSite']))        { $data['webSite'] = ''; }
        if(!isset($data['status']))         { $data['status'] = ''; }
        if(!isset($data['lat']))            { $data['lat'] = ''; }
        if(!isset($data['lng']))            { $data['lng'] = ''; }
        if(!isset($data['countryId']))      { $data['countryId'] = ''; }
    }
}