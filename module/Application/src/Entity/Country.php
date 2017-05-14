<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Class Country
 * @ORM\Entity("Application\Entity\Country")
 * @ORM\Table(name="country")
 * @property int $id
 */
class Country implements InputFilterAwareInterface
{
    protected $inputFilter;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $name;

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
        $this->id       = $data['id'];
        $this->type     = $data['type'];
        $this->name     = $data['namr'];
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
                'name'      => 'type',
                'required'  => true,
                'filters'   => [
                    [
                        'name' => 'Int'
                    ]
                ]
            ]);

            $inputFilter->add([
                'name'      => 'name',
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
                            'max'       => 30
                        ]
                    ]
                ]
            ]);


            $this->inputFilter = $inputFilter;
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}