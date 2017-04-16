<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Class Companies
 * @ORM\Entity
 * @ORM\Table(name="company")
 * @property int $id
 */
class Company implements InputFilterAwareInterface
{
    protected $inputFilter;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11, name="ID_Company")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=40, name="IPAddress")
     */
    protected $ip;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $companyName;

    /**
     * @ORM\Column(type="string",length=40)
     */
    protected $address1;

    /**
     * @ORM\Column(type="string",length=40)
     */
    protected $address2;

    /**
     * @ORM\Column(type="string",length=40)
     */
    protected $address3;

    /**
     * @ORM\Column(type="string",length=40)
     */
    protected $address4;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $postCode;

    /**
     * @ORM\Column(type="integer", length=20)
     */
    protected $telephone1;

    /**
     * @ORM\Column(type="integer", length=20)
     */
    protected $telephone2;

    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $webSite;

    /**
     * @ORM\Column(type="string", length=1)
     */
    protected $status;

    /**
     * @ORM\Column(type="integer", name="latitude")
     */
    protected $lat;

    /**
     * @ORM\Column(type="integer", name="longitude")
     */
    protected $lng;

    /**
     * @ORM\Column(type="integer", length=11, name="ID_Country")
     */
    protected $countryId;


    /**
     * Magic getter to expose protected properties
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    /**
     * Convert the object to an array
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * Populate from an array
     *
     * @param array $data
     */
    public function exchangeArray($data = [])
    {
        $this->id               = $data['id'];
        $this->ip               = $data['ip'];
        $this->companyName      = $data['companyName'];
        $this->address1         = $data['address1'];
        $this->address2         = $data['address2'];
        $this->address3         = $data['address3'];
        $this->address4         = $data['address4'];
        $this->postCode         = $data['postCode'];
        $this->telephone1       = $data['telephone1'];
        $this->telephone2       = $data['telephone2'];
        $this->webSite          = $data['webSite'];
        $this->status           = $data['status'];
        $this->lat              = $data['lat'];
        $this->lng              = $data['lng'];
        $this->countryId        = $data['countryId'];
    }

    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception('Not Used');
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if(!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add([
                'name'      => 'id',
                'required'  => true,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'ipAddress',
                'required'  => true,
                'filters'   => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 1,
                            'max'       => 40
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'companyName',
                'required'  => true,
                'filters'   => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 4,
                            'max'       => 100
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'address1',
                'required'  => false,
                'filters'   => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 0,
                            'max'       => 40
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'address2',
                'required'  => false,
                'filters'   => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 0,
                            'max'       => 40
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'address3',
                'required'  => false,
                'filters'   => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 0,
                            'max'       => 40
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'address4',
                'required'  => false,
                'filters'   => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 0,
                            'max'       => 40
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'postCode',
                'required'  => false,
                'filters'   => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 0,
                            'max'       => 10
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'telephone1',
                'required'  => false,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'telephone1',
                'required'  => false,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'webSite',
                'required'  => false,
                'filters'   => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 0,
                            'max'       => 40
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'status',
                'required'  => true,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'lat',
                'required'  => false,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'lng',
                'required'  => false,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'countryId',
                'required'  => true,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $this->inputFilter = $inputFilter;
        }
    }
}