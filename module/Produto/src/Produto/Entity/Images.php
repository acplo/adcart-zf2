<?php
namespace Produto\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="images")
*/
class Images
{
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue
    */
    protected $id;

    /**
    * @ORM\Column(name="images", type="string", length=255)
    */
    protected $images;

    /** @ORM\Column(type="string") */
    protected $image_text;

    /**
    * @ORM\ManyToOne(targetEntity="Produto\Entity\Produto", inversedBy="images")
    * @ORM\JoinColumn(name="produto_id", referencedColumnName="id", onDelete="CASCADE")
    */
    protected $produto_id;

    /**
    * @param integer $id
    * @return Images
    */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
    * @param string $images
    * @return Images
    */
    public function setNome($images)
    {
        $this->images = $images;
        return $this;
    }

    /**
    * @param string $image_text
    * @return Images
    */
    public function setImage_text($image_text)
    {
        $this->image_text = $image_text;
        return $this;
    }

    /**
    * Get images
    * @return string
    */
    public function getFileName()
    {
        return $this->filename;
    }
//
//    /**
//    * Get FileName
//    * @return string
//    */
//    public function getFilename()
//    {
//        return $this->filename;
//    }

    /**
     * @param integer $produto_id
     * @return Images
     */
    public function setProduto_id($produto_id)
    {
        $this->produto_id = $produto_id;
        return $this;
    }

    /**
     * Get not_id
     * @return integer 
     */
    public function getProduto_id()
    {
        return $this->produto_id;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }

    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray ($data = array()) 
    {
        $this->filename = $data['filename'];
        $this->image_text = $data['image_text'];
        $this->produto_id = $data['produto_id'];
    }
}