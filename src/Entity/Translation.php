<?php
namespace DoctrineORMTranslationLoader\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Translation Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="translation", uniqueConstraints={@ORM\UniqueConstraint(name="translation_uniq", columns={"translationKey", "locale", "textDomain"})}, indexes={@ORM\Index(name="locale_domain_idx", columns={"locale", "textDomain"})})
 */
class Translation implements JsonSerializable{
	
	/**
	 * @var int
	 * @ORM\Id
	 * @ORM\Column(type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @var string
	 * @ORM\Column(type="string", nullable=false)
	 */
	protected $translationKey;
	
	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	protected $textDomain = 'default';
	
	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	protected $locale;
	
	/**
	 * @var string
	 * @ORM\Column(type="text")
	 */
	protected $translation;
	
	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param int $id
	 * @return Translation
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}	
	
	/**
	 * @return string
	 */
	public function getTranslationKey() {
		return $this->translationKey;
	}

	/**
	 * @return string
	 */
	public function getLocale() {
		return $this->locale;
	}

	/**
	 * @return string
	 */
	public function getTranslation() {
		return $this->translation;
	}

	/**
	 * @return string
	 */
	public function getTextDomain() {
		return $this->textDomain;
	}

	/**
	 * @param string $translationKey
	 * @return Translation
	 */
	public function setTranslationKey($translationKey) {
		$this->translationKey = $translationKey;
		return $this;
	}

	/**
	 * @param string $locale
	 * @return Translation
	 */
	public function setLocale($locale) {
		$this->locale = $locale;
		return $this;
	}

	/**
	 * @param string $translation
	 * @return Translation
	 */
	public function setTranslation($translation) {
		$this->translation = $translation;
		return $this;
	}
	
	/**
	 * @param string $textDomain
	 * @return Translation
	 */
	public function setTextDomain($textDomain) {
		$this->textDomain = $textDomain;
		return $this;
	}
	
	/**
	 * Returns data to show in json
	 * @return array
	 */
	public function jsonSerialize() {
		return array(
			'id' => $this->getId(),
			'translationKey' => $this->getTranslationKey(),
			'locale' => $this->getLocale(),
			'translation' => $this->getTranslation(),
		);
	}

}
