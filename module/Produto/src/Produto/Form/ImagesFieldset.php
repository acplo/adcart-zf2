<?php


namespace Produto\Form;

use Produto\Entity\Images;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Element;

class ImagenesFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('images');

        $this->setHydrator(new DoctrineHydrator($objectManager, 'Produto\Entity\Images'))->setObject(new Images());

        $this->add(array(
            'name' => 'filename',
            'type'  => 'Zend\Form\Element\File',
        ));

        $this->add(array(
            'name' => 'image_text',
            'type'  => 'Zend\Form\Element\Textarea',
        ));

        $this->add(array(
            'name' => 'news_id',
            'type'  => 'Zend\Form\Element\Hidden',
        ));

    }
    public function getInputFilterSpecification()
    {
        return array(
            /*'imagen' => array(
                'required' => true
            ),*/
        );
    }
}