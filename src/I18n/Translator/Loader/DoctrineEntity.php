<?php
namespace DoctrineORMTranslationLoader\I18n\Translator\Loader;

use Doctrine\Common\Persistence\ObjectManager;
use Zend\I18n\Translator\Loader\RemoteLoaderInterface;
use DoctrineORMTranslationLoader\Entity\Translation;
use Zend\I18n\Translator\TextDomain;

class DoctrineEntity implements RemoteLoaderInterface{
	const META_PREFIX = '__META__';
    const META_PLURAL_FORMS = 'plural_forms';

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

			$translationKey = $translation->getTranslationKey();

			// Check if meta value. Meta values always start with the self::META_PREFIX prefix.
			if(substr($translationKey,0, strlen(self::META_PREFIX)) === self::META_PREFIX){
                $metaKey = substr($translationKey,strlen(self::META_PREFIX));
                $messages[''][$metaKey] = $translation->getTranslation();
            }

			// check if this is a plural translation
			if($translation->getTranslationPluralNumber() !== null){
			    $messages[$translation->getTranslationkey()][$translation->getTranslationPluralNumber()] = $translation->getTranslation();
            } else {
                $messages[$translation->getTranslationkey()] = $translation->getTranslation();
            }
		}

        $textDomain = new TextDomain($messages);

        // check if there is metadata stored
        if (array_key_exists('', $textDomain)) {
            if (isset($textDomain[''][self::META_PLURAL_FORMS])) {
                $textDomain->setPluralRule(
                    PluralRule::fromString($textDomain[''][self::META_PLURAL_FORMS])
                );
            }

            unset($textDomain['']);
        }

        return $textDomain;
	}
}