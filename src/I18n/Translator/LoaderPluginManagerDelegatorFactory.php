<?php
namespace DoctrineORMTranslationLoader\I18n\Translator;

use Zend\ServiceManager\Factory\DelegatorFactoryInterface;
use Interop\Container\ContainerInterface;

/**
 * Description of LoaderPluginManagerDelegatorFactory
 *
 * @author schurix
 */
class LoaderPluginManagerDelegatorFactory implements DelegatorFactoryInterface{
	public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null) {
		/* @var $pluginManager \Zend\I18n\Translator\LoaderPluginManager */
		$pluginManager = $callback();
		
		$pluginManager->setFactory(Loader\DoctrineEntity::class, Loader\Factory\DoctrineEntityFactory::class);
		
		return $pluginManager;
	}
}
