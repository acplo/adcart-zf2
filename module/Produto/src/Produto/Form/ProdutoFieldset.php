<?php

namespace Produto\Form;

use Produto\Entity\Produto;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class ProdutoFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct(ObjectManager $objectManager)
    {
	parent::__construct('news');

	$this->setHydrator(new DoctrineHydrator($objectManager, 'Produto\Entity\Produto'))->setObject(new Produto());

	$this->add(array(
	    'name'	 => 'id',
	    'type'	 => 'Zend\Form\Element\Hidden',
	));

	$this->add(array(
	    'name'		 => 'nome',
	    'type'		 => 'Zend\Form\Element\Text',
	    'attributes'	 => array(
		'required'	 => 'required',
		'class'		 => 'form-control',
		'placeholder'	 => 'Título',
		'autocomplete'	 => 'off',
		'maxlength'	 => '100',
	    ),
	));

	$imagesFieldset = new \Produto\Form\ImagesFieldset($objectManager);
	$this->add(array(
	    'type'		 => 'Zend\Form\Element\Collection',
	    'name'		 => 'images',
	    'options'	 => array(
		'count'		 => 1,
		'target_element' => $imagesFieldset
	    )
	));
    }

    public function getInputFilterSpecification()
    {
	return array(
	    'nome' => array(
		'required' => true
	    ),
	);
    }

}
