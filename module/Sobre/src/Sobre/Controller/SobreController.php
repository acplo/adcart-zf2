<?php

namespace Sobre\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;

use Stdlib\Model\Registry ;
use Sobre\Entity\Sobre;
use Sobre\Form\SobreForm;
class SobreController extends AbstractActionController
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Sets the EntityManager
     *
     * @param EntityManager $em
     * @access protected
     * @return SobreController
     */
    protected function setEntityManager(EntityManager $em)
    {
	$this->entityManager = $em;
	return $this;
    }

    /**
     * Returns the EntityManager
     *
     * Fetches the EntityManager from ServiceLocator if it has not been initiated
     * and then returns it
     *
     * @access protected
     * @return EntityManager
     */
    protected function getEntityManager()
    {
	if (null === $this->entityManager)
	{
	    $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
	}
	return $this->entityManager;
    }

    public function listAction()
    {
	$repository = $this->getEntityManager()->getRepository('Sobre\Entity\Sobre');
	$sobre = $repository->findAll();

	return array(
	    'sobre' => $sobre
	);
    }

    public function addAction()
    {
	$em = $this->getEntityManager();
	Registry::set('entityManager', $em);

	$sobre = new Sobre();
	$form = new SobreForm();
	$form->bind($sobre);

	return array(
	    'form' => $form
	);
    }

    public function editAction()
    {
	
    }

    public function deleteAction()
    {
	
    }

}
