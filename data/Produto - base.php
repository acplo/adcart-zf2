<?php
namespace Produto\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;
use AcploBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="produto")
 * @Form\Name("formProduto")
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Type("AcploBase\Form\AbstractForm")
 */
class Produto extends AbstractEntity
{
    /**
     * @ORM\Column(type="string")
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Nome Produto"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":100}})
     */
    protected $nome;

    /**
     * @ORM\Column(type="string")
     * @Form\Required(true)
     * @Form\Attributes({"type":"textarea"})
     * @Form\Options({"label":"Descricao"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1}})
     */
    protected $description;

    /**
     * @ORM\Column(type="string")
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Preço"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":100}})
     */
    protected $price;

    /**
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Preço custo"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":100}})
     */
    protected $priceCusted;

    /**
     * @ORM\Column(type="string")
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Tamanho"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":100}})
     */
    protected $size;

    /**
     * @ORM\Column(type="string")
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Cor"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":100}})
     */
    protected $color;

    /**
     * @ORM\Column(type="string")
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Peso"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":100}})
     */
    protected $weight; // peso
    
    /**
     * @ORM\Column(type="string")
     * @Form\Required(true)
     * @Form\Attributes({"type":"file"})
     * @Form\Options({"label":"Preço"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":100}})
     */
    protected $thumb;
    /**
     * @Form\Exclude()
     */
    protected $thumbSmal;

    public function __construct()
    {
	$this->created = new \DateTime('now');
	$this->updated = new \DateTime('now');
    }

    public function getNome()
    {
	return $this->nome;
    }

    public function getDescription()
    {
	return $this->description;
    }

    public function getPrice()
    {
	return $this->price;
    }

    public function getPriceCusted()
    {
	return $this->priceCusted;
    }

    public function getSize()
    {
	return $this->size;
    }

    public function getColor()
    {
	return $this->color;
    }

    public function getWeight()
    {
	return $this->weight;
    }

    public function getThumb()
    {
	return $this->thumb;
    }

    public function getThumbSmal()
    {
	return $this->thumbSmal;
    }

    public function setNome($nome)
    {
	$this->nome = $nome;
    }

    public function setDescription($description)
    {
	$this->description = $description;
    }

    public function setPrice($price)
    {
	$this->price = $price;
    }

    public function setPriceCusted($priceCusted)
    {
	$this->priceCusted = $priceCusted;
    }

    public function setSize($size)
    {
	$this->size = $size;
    }

    public function setColor($color)
    {
	$this->color = $color;
    }

    public function setWeight($weight)
    {
	$this->weight = $weight;
    }

    public function setThumb($thumb)
    {
	$this->thumb = $thumb;
    }

    public function setThumbSmal($thumbSmal)
    {
	$this->thumbSmal = $thumbSmal;
    }

}
