<?php
namespace DoctrineORMTranslationLoader\I18n\Translator;

use Zend\ServiceManager\Factory\DelegatorFactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\LoaderPluginManager;

/**
 * Description of TranslatorServiceDelegatorFactory
 *
 * @author schurix
 */
class TranslatorServiceDelegatorFactory implements DelegatorFactoryInterface{
	public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null) {
		/* @var $translator \Zend\I18n\Translator\Translator */
		$translator = $callback();
		
		if(is_callable([$translator, 'setPluginManager']) && $container->has(LoaderPluginManager::class)){
			$translator->setPluginManager($container->get(LoaderPluginManager::class));
		}
		
		return $translator;
	}
}
