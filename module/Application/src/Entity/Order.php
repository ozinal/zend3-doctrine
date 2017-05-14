<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Class Order
 * @ORM\Entity("Application\Entity\Order")
 * @ORM\Table(name="order")
 * @property int $id
 */
class Order implements InputFilterAwareInterface
{
    protected $inputFilter;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=20)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    protected $transaction;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateTime;

    /**
     * @ORM\Column(type="integer", length=10)
     */
    protected $quantity;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=4)
     */
    protected $salePrice;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    protected $userId;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    protected $productId;

    /**
     * Magic getter to expose protected properties
     *
     * @param mixed $property
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties
     *
     * @param string $property
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
        $this->id               = $data['id'];
        $this->transaction      = $data['transaction'];
        $this->dateTime         = $data['dateTime'];
        $this->quantity         = $data['quantity'];
        $this->salePrice        = $data['salePrice'];
        $this->userId           = $data['userId'];
        $this->productId        = $data['productId'];
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
        throw new \Exception('Not used');
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if(!$this->inputFilter)
        {
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
                'name'      => 'transaction',
                'required'  => true,
                'filters'   => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators' => [
                    [
                        'name'      => 'StringLength',
                        'options'   => [
                            'encoding'  => 'UTF-8',
                            'min'       => 10,
                            'max'       => 250
                        ]
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'dateTime',
                'required'  => true,
                'filters'   => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators'    => [
                    'name'      => 'StringLength',
                    'options'   => [
                        'encoding'  => 'UTF-8',
                        'min'       => 1,
                        'max'       => 25
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'quantity',
                'required'  => true,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'quantity',
                'required'  => true,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'salePrice',
                'required'  => true,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'userId',
                'required'  => true,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'productId',
                'required'  => true,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            return $inputFilter;
        }
        return $this->inputFilter;
    }
}