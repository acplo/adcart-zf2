<?php

namespace Produto\Form;

use Cliente\Entity\Cliente;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class CreateClienteForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('create-cliente-form');

        // The form will hydrate an object of type "BlogPost"
        $this->setHydrator(new DoctrineHydrator($objectManager));

        // Add the user fieldset, and set it as the base fieldset
        $blogPostFieldset = new ClienteFieldset($objectManager);
        $blogPostFieldset->setUseAsBaseFieldset(true);
        $this->add($blogPostFieldset);

        // … add CSRF and submit elements …

        // Optionally set your validation group here
    }
}