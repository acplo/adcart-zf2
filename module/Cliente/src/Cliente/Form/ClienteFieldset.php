<?php

namespace Cliente\Form;

use Cliente\Entity\Cliente;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class ClienteFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct(ObjectManager $objectManager)
    {
	parent::__construct('cliente');

	$this->setHydrator(new DoctrineHydrator($objectManager))
		->setObject(new Cliente());

	$this->add(array(
	    'type'	 => 'Zend\Form\Element\Hidden',
	    'name'	 => 'id'
	));

	$this->add(array(
	    'name'		 => 'plano',
	    'type'		 => 'DoctrineModule\Form\Element\ObjectSelect',
	    'options'	 => array(
		'label'		 => 'Plano',
		'object_manager' => $objectManager,
		'target_class'	 => 'Cliente\Entity\Plano',
		'property'	 => 'nome'
	    ),
	    'attributes'	 => array(
		'class' => 'form-control input-sm'
	    )
	));
	$this->add(array(
	    'type'		 => 'Zend\Form\Element\Text',
	    'name'		 => 'nome',
	    'options'	 => array(
		'label' => 'Nome:'
	    )
	));
	$this->add(array(
	    'type'		 => 'Zend\Form\Element\File',
	    'name'		 => 'imagem',
	    'options'	 => array(
		'label' => 'Image:'
	    )
	));
	$this->add(array(
	    'name'		 => 'submit',
	    'attributes'	 => array(
		'type'	 => 'submit',
		'value'	 => 'Go',
		'class'	 => 'btn btn-blue btn-gradient',
		'id'	 => 'submitbutton'
	    )
	));
    }

    public function getInputFilterSpecification()
    {
	return array(
	    'id'	 => array(
		'required' => false
	    ),
	    'nome'	 => array(
		'required' => true
	    )
	);
    }

}
