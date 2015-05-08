<?php

namespace Cart\Controller;

use AcploBase\Controller\AbstractCrudController;
use AcploCart\Controller\Plugin\AcploCartDoctrineORM;
use AcploCart\Controller\Plugin\AcploCart;

class CrudController extends AbstractCrudController
{

    public function listAction()
    {
	return (array(
	    'items'		 => $this->AcploCart()->cart(),
	    'total_items'	 => $this->AcploCart()->total_items(),
	    'total'		 => $this->AcploCart()->total(),
	));
    }

    public function destroyAction()
    {
	$this->AcploCart()->destroy();
	return $this->redirect()->toRoute('cart/list');
    }

    public function addAction()
    {
//         return new ViewModel();
	$product[0] = array(
	    'id'		 => '36912341',
	    'qty'		 => 1,
	    'price'		 => 39.95,
	    'name'		 => 'T-Shirt Large',
	    'options'	 => array('Size' => 'M', 'Color' => 'Black')
	);
	$product[1] = array(
	    'id'		 => '36912355',
	    'qty'		 => 1,
	    'price'		 => 50.95,
	    'name'		 => 'T-Shirt Small',
	    'options'	 => array('Size' => 'M', 'Color' => 'Black')
	);
	print_r($product);
	foreach ($product as $value)
	{
	    $this->AcploCart()->insert($value);
	}
	return $this->redirect()->toRoute('cart/list');
    }

}
