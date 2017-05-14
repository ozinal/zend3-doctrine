<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\Column(type="integer", length=11)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $sku;

    /**
     * @ORM\Column(type="string", length=250)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=65535)
     */
    protected $description;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $dateTime;


    /**
     * @ORM\Column(type="integer", length=11)
     */
    protected $categoryId;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Application\Entity\Post", mappedBy="product")
     */
    protected $posts;

    /**
     * many customers:many products
     * NOTE: you don't need to specify "inversedBy" as both sides could be considering "inverse"
     * @ORM\ManyToMany(targetEntity="Application\Entity\User", inversedBy="products")
     * @ORM\JoinTable(name="product_user",
     *      joinColumns={@ORM\JoinColumn(name="productId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="userId", referencedColumnName="id")}
     *      )
     */
    protected $users;

    public function __construct() {
        $this->posts = new ArrayCollection();
        $this->users = new ArrayCollection();
    }


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

    /**
     * @return mixed
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param mixed $posts
     */
    public function setPosts($posts)
    {
        $this->posts[] = $posts;
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

    /**
     * @return ArrayCollection
     */
    public function getUsers(): ArrayCollection
    {
        return $this->users;
    }

    /**
     * @param ArrayCollection $users
     */
    public function setUsers(ArrayCollection $users)
    {
        $this->users[] = $users;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }
}