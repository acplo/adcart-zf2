<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
	$eventManager = $e->getApplication()->getEventManager();
	$moduleRouteListener = new ModuleRouteListener();
	$moduleRouteListener->attach($eventManager);
	$t = $e->getTarget();
	$t->getEventManager()->attach($t->getServiceManager()->get('ZfcRbac\View\Strategy\RedirectStrategy'));
    }

    public function getConfig()
    {
	return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfiguration()
    {
	return array(
	    'factories' => array(
		'db-adapter' => function($sm) {
		    $config = $sm->get('config');
		    $config = $config['db'];
		    $dbAdapter = new DbAdapter($config);
		    return $dbAdapter;
		},
	    ),
	);
    }

    public function getEntityManager()
    {
	if (null === $this->_em)
	{
	    $this->_em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
	}
	return $this->_em;
    }

    protected function getObjectManager()
    {
	if (!$this->_objectManager)
	{
	    $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
	}

	return $this->_objectManager;
    }

    public function getAutoloaderConfig()
    {
	return array(
	    'Zend\Loader\StandardAutoloader' => array(
		'namespaces' => array(
		    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
		),
	    ),
	);
    }

}
