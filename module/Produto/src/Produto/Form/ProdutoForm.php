<?php
namespace Produto\Form;
 
use Zend\Form\Form;
use Produto\Entity\Produto as ProdutoEntity;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\InputFilter\InputFilter;


use Produto\Entity\Produto;
use Produto\Entity\Images;

class ProdutoForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('new_news');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');

        $this->setHydrator(new DoctrineHydrator($objectManager, '\Produto\Entity\Produto'));

        $newsFieldset = new \Produto\Form\ProdutoFieldset($objectManager);
        $newsFieldset->setUseAsBaseFieldset(true);
        $this->add($newsFieldset);

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'class' => 'btn btn-primary',
                'id' => 'enviar',
            ),
        ));
    }
}