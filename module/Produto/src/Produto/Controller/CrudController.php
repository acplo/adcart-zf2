<?php

namespace Produto\Controller;

use Produto\Entity\Produto as ProdutoEntity;
use Produto\Entity\Images as ImagesEntity;
use AcploBase\Controller\AbstractCrudController;

class CrudController extends AbstractCrudController
{

    public function addAction()
    {
	if (method_exists($this, 'getAddForm'))
	{
	    $form = $this->getAddForm();
	}
	else
	{
	    $form = $this->getForm();
	}

	$classe = $this->getEntityClass();
	$entity = new $classe();
	$form->bind($entity);

	$redirectUrl = $this->url()->fromRoute($this->getActionRoute(), [], true);
	$prg = $this->fileprg($form, $redirectUrl, true);

	if ($prg instanceof Response)
	{
	    return $prg;
	}
	elseif ($prg === false)
	{
	    
	    $this->getEventManager()->trigger('getForm', $this, [
		'form'		 => $form,
		'entityClass'	 => $this->getEntityClass(),
		'entity'	 => $entity,
	    ]);

	    return [
		'entityForm'	 => $form,
		'entity'	 => $entity,
	    ];
	}

	$this->getEventManager()->trigger('getForm', $this, [
	    'form'		 => $form,
	    'entityClass'	 => $this->getEntityClass(),
	    'entity'	 => $entity,
	]);

	$savedEntity = $this->getEntityService()->save($form, $entity);

	if (!$savedEntity)
	{
	    return [
		'entityForm'	 => $form,
		'entity'	 => $entity,
	    ];
	}

	$this->flashMessenger()->addSuccessMessage($this->getServiceLocator()
			->get('translator')
			->translate($this->successAddMessage));


	
//	return $this->redirect()->toRoute($this->getActionRoute('list'), [], true);
    }

}
