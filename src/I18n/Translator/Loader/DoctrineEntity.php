<?php
namespace DoctrineORMTranslationLoader\I18n\Translator\Loader;

use Doctrine\Common\Persistence\ObjectManager;
use Zend\I18n\Translator\Loader\RemoteLoaderInterface;
use DoctrineORMTranslationLoader\Entity\Translation;
use Zend\I18n\Translator\TextDomain;

class DoctrineEntity implements RemoteLoaderInterface{
	
	/** @var ObjectManager */
	protected $objectManager;
	
	function __construct(ObjectManager $objectManager) {
		$this->objectManager = $objectManager;
	}
	
	/**
	 * @return ObjectManager
	 */
	function getObjectManager() {
		return $this->objectManager;
	}

	public function load($locale, $textDomain) {
		$repository = $this->getObjectManager()->getRepository(Translation::class);
		// get all tanslations for namespace and locale
		$translations = $repository->findBy(array(
			'locale' => $locale,
			'textDomain' => $textDomain,
		));
		
		// create TextDomain object
		$messages = array();
		foreach($translations as $translation){
			/* @var $translation Translation */
			$messages[$translation->getTranslationkey()] = $translation->getTranslation();
		}
		return new TextDomain($messages);
	}
}