<?php

namespace Produto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Produto\Entity\Images;
use Produto\Entity\Produto;
use Produto\Form\Produto as ProdutoForm;
// for the form
use Zend\Form\Element;

class ProdutosController extends AbstractActionController
{

    public function addAction()
    {
	$form = new ProdutoForm('produto', array(
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
		if (is_array($data->getImages()) && !empty($data->getImages()['tmp_name']))
		{
		    $data->setFoto($data->getFoto()['tmp_name']);
		}
		else
		{
		    $data->setImages("");
		}
		$this->getServiceLocator()
			->get('Doctrine\ORM\EntityManager')
			->persist($data);
		$this->getServiceLocator()
			->get('Doctrine\ORM\EntityManager')
			->flush();
		$this->redirect()->toRoute('produto/list');
	    }
	}
//	$form->prepare();
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
		->getRepository('Application\Entity\Cliente')
		->findOneById($id);
	$fotoAtual = $cliente->getFoto();
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
		if (is_array($data->getFoto()) && !empty($data->getFoto()['tmp_name']))
		{
		    if (is_file($fotoAtual))
		    {
			unlink($fotoAtual);
		    }
		    $data->setFoto($data->getFoto()['tmp_name']);
		}
		else
		{
		    $data->setFoto($fotoAtual);
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
		->getRepository('Application\Entity\Cliente')
		->findOneById($id);
	if (is_file($cliente->getFoto()))
	{
	    unlink($cliente->getFoto());
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
