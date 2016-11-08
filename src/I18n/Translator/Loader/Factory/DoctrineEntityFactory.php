<?php

namespace DoctrineORMTranslationLoader\I18n\Translator\Loader\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use DoctrineORMTranslationLoader\I18n\Translator\Loader\DoctrineEntity;

/**
 * 
 *
 * @author schurix
 */
class DoctrineEntityFactory implements FactoryInterface{
	
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
		$loader = new DoctrineEntity();
		
		return $loader;
	}

}
