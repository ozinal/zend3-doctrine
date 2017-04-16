<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Class User
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @property int $id
 * @property string $userName
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property int $balance
 * @property string $accessLevel
 * @property string $status
 * @property string $created
 * @property string $modified
 * @property string $loggedOn
 * @property string $loggedOff
 * @property string $token
 * @property int $countryId
 * @property int $companyId
 */
class User implements InputFilterAwareInterface
{
    protected $inputFilter;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11, name="ID_User")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $userName;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", unique=true, length=32)
     */
    protected $password;

    /**
     * @ORM\Column(type="decimal",precision=15,scale=2)
     */
    protected $balance;

    /**
     * @ORM\Column(type="integer", length=4)
     */
    protected $accessLevel;

    /**
     * @ORM\Column(type="integer", length=4)
     */
    protected $status;

    /**
     * @ORM\Column(type="string")
     */
    protected $created;

    /**
     * @ORM\Column(type="string")
     */
    protected $modified;

    /**
     * @ORM\Column(type="string")
     */
    protected $loggedOn;

    /**
     * @ORM\Column(type="string")
     */
    protected $loggedOff;

    /**
     * @ORM\Column(type="string")
     */
    protected $token;

    /**
     * @ORM\Column(type="integer", length=11, name="ID_Country")
     */
    protected $countryId;

    /**
     * @ORM\Column(type="integer", length=11, name="ID_Company")
     */
    protected $companyId;

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
     * @param $property
     * @param $value
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
        $this->ID_User      = $data['id'];
        $this->userName     = $data['userName'];
        $this->firstName    = $data['firstName'];
        $this->lastName     = $data['lastName'];
        $this->email        = $data['email'];
        $this->password     = $data['password'];
        $this->balance      = $data['balance'];
        $this->accessLevel  = $data['accessLevel'];
        $this->status       = $data['status'];
        $this->created      = $data['created'];
        $this->modified     = $data['modified'];
        $this->loggedOn     = $data['loggedOn'];
        $this->loggedOff    = $data['loggedOff'];
        $this->token        = $data['token'];
        $this->countryId    = $data['countryId'];
        $this->companyId    = $data['companyId'];
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
                'name'      => 'userName',
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
                            'max'       => 30
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'firstName',
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
                            'max'       => 30
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'lastName',
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
                            'max'       => 30
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'email',
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
                            'max'       => 50
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'password',
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
                            'max'       => 32
                        ]
                    ]
                ]
            ]);


            $inputFilter->add([
                'name'      => 'accessLevel',
                'required'  => true,
                'filters'   => [
                    [
                        'name'  => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'status',
                'required'  => true,
                'filters'   => [
                    [
                        'name'  => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'created',
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
                            'min'       => 10,
                            'max'       => 32
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'modified',
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
                            'min'       => 10,
                            'max'       => 32
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'loggedOn',
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
                            'min'       => 10,
                            'max'       => 32
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'loggedOff',
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
                            'min'       => 10,
                            'max'       => 32
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'token',
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
                            'min'       => 1,
                            'max'       => 50
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'countryId',
                'required'  => false,
                'filters'   => [
                    [
                        'name'  => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'companyId',
                'required'  => false,
                'filters'   => [
                    [
                        'name'  => 'Int'
                    ]
                ]
            ]);

            $this->inputFilter = $inputFilter;
        }
    }
}