<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Class Post
 * @ORM\Entity("Application\Entity\Post")
 * @ORM\Table(name="post")
 * @property int $id
 */
class Post implements InputFilterAwareInterface
{
    protected $inputFilter;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=20)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=65535)
     */
    protected $description;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    protected $productId;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    protected $categoryId;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    protected $userId;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $dateTime;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Application\Entity\Product", inversedBy="posts")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    protected $product;

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
        $this->title            = $data['title'];
        $this->description      = $data['description'];
        $this->productId        = $data['productId'];
        $this->categoryId       = $data['categoryId'];
        $this->dateTime         = $data['dateTime'];
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
                'name'      => 'title',
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
                'name'      => 'description',
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
                            'min'       => 0,
                            'max'       => 65535
                        ]
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

            $inputFilter->add([
                'name'      => 'categoryId',
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

            return $inputFilter;
        }
        return $this->inputFilter;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}