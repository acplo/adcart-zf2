<?php

namespace Cliente\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use AcploBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="plano")
 */
class Plano extends AbstractEntity
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nome;

    /**
     * construtor
     */
    public function __construct()
    {
	parent::__construct();
    }

    public function getId()
    {
	return $this->id;
    }

    public function getNome()
    {
	return $this->nome;
    }

    public function setId($id)
    {
	$this->id = $id;
	return $this;
    }

    public function setNome($nome)
    {
	$this->nome = $nome;
	return $this;
    }


}
