<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Class Country
 * @ORM\Entity("Application\Entity\Product")
 * @ORM\Table(name="product")
 * @property int $id
 */
class Product implements InputFilterAwareInterface
{
    protected $inputFilter;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11, name="ID_Product")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=45, name="SKU")
     */
    protected $sku;

    /**
     * @ORM\Column(type="string", length=250, name="Title")
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=65535, name="Description")
     */
    protected $description;

    /**
     * @ORM\Column(type="string", length=20, name="DateTime")
     */
    protected $dateTime;


    /**
     * @ORM\Column(type="integer", length=11, name="ID_Category")
     */
    protected $categoryId;


    /**
     * Magic getter to expose protected properties
     *
     * @param mixed $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties
     *
     * @param mixed $property
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

    public function exchangeArray($data = [])
    {
        $this->id           = $data['id'];
        $this->sku          = $data['sku'];
        $this->title        = $data['title'];
        $this->description  = $data['description'];
        $this->dateTime     = $data['dateTime'];
        $this->categoryId   = $data['categoryId'];
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
                'name'          => 'id',
                'required'      => true,
                'filters'       => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'sku',
                'required'  => false,
                'filters'    => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 1,
                            'max'       => 45
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'title',
                'required'  => true,
                'filters'    => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 5,
                            'max'       => 250
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'description',
                'required'  => true,
                'filters'    => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 0,
                            'max'       => 65535
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'dateTime',
                'required'  => true,
                'filters'    => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 1,
                            'max'       => 65535
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'categoryId',
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