<?php

namespace DoctrineORMTranslationLoader\I18n\Translator\Loader\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use DoctrineORMTranslationLoader\I18n\Translator\Loader\DoctrineEntity;
use Doctrine\ORM\EntityManager;

/**
 * 
 *
 * @author schurix
 */
class DoctrineEntityFactory implements FactoryInterface{
	
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
		$em = $container->get(EntityManager::class);
		
		$loader = new DoctrineEntity($em);
		
		return $loader;
	}

}
