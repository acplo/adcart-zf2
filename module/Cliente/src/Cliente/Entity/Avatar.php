<?php

namespace Cliente\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 */
class Avatar
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
//
//    /**
//     * @ORM\ManyToOne(targetEntity="Cliente\Entity\Cliente", inversedBy="avatar")
//     * @ORM\JoinColumn(nullable=false, onDelete="RESTRICT")
//     */
//    protected $clienteId;

    /**
     * @ORM\ManyToOne(targetEntity="Cliente\Entity\Cliente", inversedBy="avatar")
     */
    protected $clienteId;

    /**
     * @ORM\Column(type="string")
     */
    protected $avatar;

    public function getId()
    {
	return $this->id;
    }

    /**
     * Allow null to remove association
     */
    public function setCliente(Cliente $cliente = null)
    {
	$this->blogPost = $cliente;
    }

    public function getCliente()
    {
	return $this->blogPost;
    }

    public function __construct()
    {
	$this->created = new \DateTime('now');
	$this->updated = new \DateTime('now');
	$this->avatar = new ArrayCollection();
    }

    public function getAvatar()
    {
	return $this->avatar;
    }

    public function setAvatar($avatar)
    {
	$this->avatar = $avatar;
    }

   

}
