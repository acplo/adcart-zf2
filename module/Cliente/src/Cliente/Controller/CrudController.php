<?php

namespace Cliente\Controller;

use AcploBase\Controller\AbstractCrudController;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Form\Annotation\AnnotationBuilder;
use Cliente\Entity\Cliente as ClienetEntity;
use Cliente\Entity\Plano as PlanoEntity;
use Cliente\Entity\Avatar as AvatarEntity;
use Doctrine\ORM\QueryBuilder;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Cliente\Form\CreateClienteForm;
/**
 * Upload files for zend 
 */
use Zend\Http\PhpEnvironment\Request;
use Zend\Filter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\InputFilter\FileInput;
use Zend\Validator;
use Zend\Validator\File\Size;

class CrudController extends AbstractCrudController
{

    public function addAction()
    {
	echo '<pre>';

	// Get your ObjectManager from the ServiceManager
	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

	// Create the form and inject the ObjectManager
	$form = new CreateClienteForm($objectManager);

	// Create a new, empty entity and bind it to the form
	$cliente = new ClienetEntity();
	$plano = new PlanoEntity();
	$avatar = new AvatarEntity();
	$form->bind($cliente);


	if ($this->request->isPost())
	{
	    $form->setData($this->request->getPost());
	    $File = $this->params()->fromFiles('fileupload');

	    if ($form->isValid())
	    {

		$size = new Size(array('max' => 2000000)); //minimum bytes filesize

		$adapter = new \Zend\File\Transfer\Adapter\Http();
		$adapter->setValidators(array($size), $File['name']);
		$nonFile = $this->params()->fromPost();
//		print_r($nonFile);
		$data = array_merge(
			$nonFile, array('imagem' => $File['name'])
		);
		if (!$adapter->isValid())
		{
		    $dataError = $adapter->getMessages();
		    $error = array();
		    foreach ($dataError as $key => $row)
		    {
			$error[] = $row;
		    }
		    $form->setMessages(array('fileupload' => $error));
		}
		else
		{
		    $adapter->setDestination(getcwd() . '/public/uploads');
		    if ($adapter->receive($File['name']))
		    {
//			print_r($data);
			$data = $form->getData();
		    }
		}

		$hydrator = new DoctrineHydrator($objectManager);
		$data = array(
		    'nome'	 => $data->getNome(),
		    'avatar' => $avatar,
		);
//		$data = $form->getData();
		print_r($data);
		$city = $hydrator->hydrate($data, $cliente);

//		echo $city->getName(); // prints "Paris"
		$dataArray = $hydrator->extract($cliente);
		print_r($dataArray);
		$objectManager->persist($cliente);
		$objectManager->flush();
		die();
//
//
//		$objectManager->persist($cliente);
//		$objectManager->flush();
//
//		$avatar->setAvatar($File['name']);
//		$avatar->setClienteId($cliente->getId());
//		$objectManager->persist($avatar);
//		$objectManager->flush();
//
////		$files = $adapter->getFileInfo();
////		die();
//		$objectManager->flush();
	    }
	}

	return array('form' => $form);
    }

    public function editAction()
    {
	// Get your ObjectManager from the ServiceManager
	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

	// Create the form and inject the ObjectManager
	$form = new UpdateBlogPostForm($objectManager);

	// Create a new, empty entity and bind it to the form
	$cliente = $this->userService->get($this->params('cliente_id'));
	$form->bind($cliente);

	if ($this->request->isPost())
	{
	    $form->setData($this->request->getPost());

	    if ($form->isValid())
	    {
		// Save the changes
		$objectManager->flush();
	    }
	}

	return array('form' => $form);
    }

}
