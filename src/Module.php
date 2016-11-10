<?php
namespace DoctrineORMTranslationLoader;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\I18n\Translator\LoaderPluginManager;
use Zend\I18n\Translator\TranslatorInterface;

class Module implements ConfigProviderInterface, ServiceProviderInterface{
	
	public function getConfig() {
		return include __DIR__ . '/../config/module.config.php';
	}

	public function getServiceConfig() {
		return [
			'factories' => [
			],
			'delegators' => [
				LoaderPluginManager::class => [
					I18n\Translator\LoaderPluginManagerDelegatorFactory::class
				],
				TranslatorInterface::class => [
					I18n\Translator\TranslatorServiceDelegatorFactory::class,
				],
			],
		];
	}

}