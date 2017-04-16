<?php
namespace Application\Service;

use Application\Entity\Company;

class CompanyService
{
    public function showCompanyHeader()
    {

    }

    /**
     * @param Company $company
     * @return array
     */
    public function showCompany(Company $company)
    {
        return [
            'id'            => $company->__get('id'),
            'ip'            => $company->__get('ip'),
            'companyName'   => $company->__get('companyName'),
            'address1'      => $company->__get('address1'),
            'address2'      => $company->__get('address2'),
            'address3'      => $company->__get('address3'),
            'address4'      => $company->__get('address4'),
            'postCode'      => $company->__get('postCode'),
            'telephone1'    => $company->__get('telephone1'),
            'telephone2'    => $company->__get('telephone2'),
            'webSite'       => $company->__get('webSite'),
            'status'        => $company->__get('status'),
            'lat'           => $company->__get('lat'),
            'lng'           => $company->__get('lng'),
            'countryId'     => $company->__get('countryId')
        ];
    }
}