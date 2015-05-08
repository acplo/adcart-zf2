<?php

namespace Cart\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use AcploBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cart")
 * @Form\Name("formCart")
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Type("AcploBase\Form\AbstractForm")
 */
class Cart extends AbstractEntity
{

    /**
     * @ORM\Column(type="string")
     * @var type 
     */
    protected $qty;

    /**
     * @ORM\Column(type="string")
     * @var type 
     */
    protected $price;

    /**
     * @ORM\Column(type="string")
     * @var type 
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     * @var type 
     */
    protected $options;

    /**
     * @ORM\Column(type="string")
     * @var type 
     */
    protected $vat;

    public function __construct()
    {
	$this->created = new \DateTime('now');
	$this->updated = new \DateTime('now');
    }

    public function getQty()
    {
	return $this->qty;
    }

    public function getPrice()
    {
	return $this->price;
    }

    public function getName()
    {
	return $this->name;
    }

    public function getOptions()
    {
	return $this->options;
    }

    public function getVat()
    {
	return $this->vat;
    }

    public function setQty(type $qty)
    {
	$this->qty = $qty;
    }

    public function setPrice(type $price)
    {
	$this->price = $price;
    }

    public function setName(type $name)
    {
	$this->name = $name;
    }

    public function setOptions(type $options)
    {
	$this->options = $options;
    }

    public function setVat(type $vat)
    {
	$this->vat = $vat;
    }

}
