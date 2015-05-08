<?php

namespace Cliente\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use AcploBase\Entity\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="cliente")
 */
class Cliente extends AbstractEntity
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
     * @ORM\ManyToOne(targetEntity="Cliente\Entity\Plano", inversedBy="plano")
     * @ORM\JoinColumn(nullable=false, onDelete="RESTRICT")
     */
    protected $plano;
//
//    /**
//     * @ORM\OneToMany(targetEntity="Cliente\Entity\Avatar", mappedBy="avatar")
//     * @ORM\JoinColumn(nullable=false)
//     */
    /**
     * @ORM\OneToMany(targetEntity="Cliente\Entity\Avatar", mappedBy="Cliente")
     */
    protected $avatar;

    public function __construct()
    {
	$this->created = new \DateTime('now');
	$this->updated = new \DateTime('now');
	$this->avatar = new ArrayCollection();
    }

    public function getId()
    {
	return $this->id;
    }

    public function getNome()
    {
	return $this->nome;
    }

    public function getPlano()
    {
	return $this->plano;
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

    public function setPlano(Plano $plano = null)
    {
	$this->plano = $plano;
	return $this;
    }

    public function getAvatar()
    {
	return $this->avatar;
    }

    public function setAvatar($avatar)
    {
	$this->avatar = $avatar;
	return $this;
    }

    public function addAvatar(Collection $tags)
    {
	foreach ($tags as $tag)
	{
	    $tag->setBlogPost($this);
	    $this->tags->add($tag);
	}
    }

    public function removeAvatar(Collection $tags)
    {
	foreach ($tags as $tag)
	{
	    $tag->setBlogPost(null);
	    $this->tags->removeElement($tag);
	}
    }


}
