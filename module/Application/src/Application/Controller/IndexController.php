<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexCart()
    {	
	$this->AcploCart()->destroy();
    }
    
    public function cartAction()
    {
//         return new ViewModel();
	$product[0] = array(
	    'id'		 => 'cod_123abc00a',
	    'qty'		 => 1,
	    'price'		 => 39.95,
	    'name'		 => 'T-Shirt Large',
	    'options'	 => array('Size' => 'M', 'Color' => 'Black')
	);
	$product[1] = array(
	    'id'		 => 'cod_123abc',
	    'qty'		 => 1,
	    'price'		 => 39.95,
	    'name'		 => 'T-Shirt Small',
	    'options'	 => array('Size' => 'M', 'Color' => 'Black')
	);
	foreach ($product as $value)
	{
	    $this->AcploCart()->insert($value);
	}
	return new ViewModel(array(
	    'items'		 => $this->AcploCart()->cart(),
	    'total_items'	 => $this->AcploCart()->total_items(),
	    'total'		 => $this->AcploCart()->total(),
	));
    }

    public function destroyCart()
    {	
	$this->AcploCart()->destroy();
    }
    
    
}
