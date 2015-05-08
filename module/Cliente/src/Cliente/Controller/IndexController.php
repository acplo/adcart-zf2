<?php

namespace Cliente\Controller;

use AcploBase\Controller\AbstractCrudController;
use Zend\Mvc\Controller\AbstractActionController;
use Cliente\Form\Cliente as ClienteForm;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
	$clientes = $this->getServiceLocator()
		->get('Doctrine\ORM\EntityManager')
		->getRepository('Cliente\Entity\Cliente')
		->findAll();
	return array(
	    'clientes' => $clientes
	);
    }

    public function addAction()
    {
	// Get your ObjectManager
	$objectManager = $this->getEntityManager();

	$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
	$form = new ClienteForm('cliente', array(
	    'om' => $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
	));
	if ($this->getRequest()->isPost())
	{
	    $form->setData(array_merge_recursive($this->getRequest()
				    ->getPost()
				    ->toArray(), $this->getRequest()
				    ->getFiles()
				    ->toArray()));
	    if ($form->isValid())
	    {
		$data = $form->getData();
//
//		print_r($data->getAvatar());

		if (is_array($data->getAvatar()) && !empty($data->getAvatar()['tmp_name']))
		{
		    if (!empty($data->getAvatar()['tmp_name']))
		    {
			$mime_type = $data->getAvatar()['type'];
			switch ($mime_type)
			{
			    case "image/jpeg":
//				echo "file is jpeg type";
				break;
			    case "image/gif":
//				echo "file is gif type";
				break;
			    case "image/png":
//				echo "file is gif type";
				break;
			    default:
				echo "file is an image, but not of gif or jpeg type";
			}
			$filename = str_replace(' ', '', $data->getAvatar()['name']);
			$filename = 'uploads/' . time() . '_' . $filename;
			die($filename);
			$data->setAvatar($filename);
		    }
		    else
		    {
			echo "file is not a valid image file";
		    }
		}
		else
		{
		    $data->setAvatar("");
		}
		$this->getServiceLocator()
			->get('Doctrine\ORM\EntityManager')
			->persist($data);
		$this->getServiceLocator()
			->get('Doctrine\ORM\EntityManager')
			->flush();
		$this->redirect()->toRoute('cliente/list');
	    }
	}
	$form->prepare();
	return array(
	    'form' => $form
	);
    }

    public function editarAction()
    {
	$form = new ClienteForm('cliente', array(
	    'om' => $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
	));
	$id = $this->params()->fromRoute('id');
	$cliente = $this->getServiceLocator()
		->get('Doctrine\ORM\EntityManager')
		->getRepository('Cliente\Entity\Cliente')
		->findOneById($id);
	$fotoAtual = $cliente->getAvatar();
	$form->bind($cliente);

	if ($this->getRequest()->isPost())
	{
	    $form->setData(array_merge_recursive($this->getRequest()
				    ->getPost()
				    ->toArray(), $this->getRequest()
				    ->getFiles()
				    ->toArray()));
	    if ($form->isValid())
	    {
		$data = $form->getData();
		if (is_array($data->getAvatar()) && !empty($data->getAvatar()['tmp_name']))
		{
		    if (is_file($fotoAtual))
		    {
			unlink($fotoAtual);
		    }
		    $data->setAvatar($data->getAvatar()['tmp_name']);
		}
		else
		{
		    $data->setAvatar($fotoAtual);
		}

		$this->getServiceLocator()
			->get('Doctrine\ORM\EntityManager')
			->persist($data);
		$this->getServiceLocator()
			->get('Doctrine\ORM\EntityManager')
			->flush();
		$this->redirect()->toRoute('tutorial');
	    }
	}
	$form->prepare();
	return array(
	    'form'		 => $form,
	    'cliente'	 => $cliente
	);
    }

    public function removerAction()
    {
	$id = $this->params()->fromRoute('id');
	$cliente = $this->getServiceLocator()
		->get('Doctrine\ORM\EntityManager')
		->getRepository('Cliente\Entity\Cliente')
		->findOneById($id);
	if (is_file($cliente->getAvatar()))
	{
	    unlink($cliente->getAvatar());
	}
	$this->getServiceLocator()
		->get('Doctrine\ORM\EntityManager')
		->remove($cliente);
	$this->getServiceLocator()
		->get('Doctrine\ORM\EntityManager')
		->flush();
	$this->redirect()->toRoute('tutorial');
    }

}
