<?php
namespace Application\Service\DBAL;

class CompanyService
{
    const TABLE = 'company';

    protected $cols = [
        'id'            => 'ID_Company',
        'ip'            => 'IPAddress',
        'companyName'   => 'CompanyName',
        'address1'      => 'Address1',
        'address2'      => 'Address2',
        'address3'      => 'Address3',
        'address4'      => 'Address4',
        'postCode'      => 'PostCode',
        'telephone1'    => 'Telephone1',
        'telephone2'    => 'Telephone2',
        'webSite'       => 'WebSite',
        'status'        => 'Status',
        'lat'           => 'Latitude',
        'lng'           => 'Longitude',
        'countryId'     => 'ID_Country'
    ];

    public function getTableName()
    {
        return self::TABLE;
    }

    public function getCols()
    {
        return $this->cols;
    }

    public function showCompany(array $company = NULL)
    {
        return [
            'id'            => $company['id'],
            'ip'            => $company['ip'],
            'companyName'   => $company['companyName'],
            'address1'      => $company['address1'],
            'address2'      => $company['address2'],
            'address3'      => $company['address3'],
            'address4'      => $company['address4'],
            'postCode'      => $company['postCode'],
            'telephone1'    => $company['telephone1'],
            'telephone2'    => $company['telephone2'],
            'webSite'       => $company['webSite'],
            'status'        => $company['status'],
            'lat'           => $company['lat'],
            'lng'           => $company['lng'],
            'countryId'     => $company['countryId']
        ];
    }

    /**
     * Checks to see if any array params are not set
     * Data is assumed to be in the form of an array with the following fields:
     * id, ip, companyName, address1, address2, address3, address4, postCode, telephone1, telephone2, webSite, status, lat, lng, countryId
     *
     * @param array $data
     * @return array
     */
    public function checkData(array $data)
    {
        $newData = [];
        foreach ($this->cols as $column) {
            if(isset($data[$column])) {
                $newData[$column] = $data[$column];
            } else {
                $newData[$column] = '';
            }
        }
        return $newData;
    }

}