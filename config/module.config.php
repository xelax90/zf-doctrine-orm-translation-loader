<?php
namespace DoctrineORMTranslationLoader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
	// language options
	'translator' => [
		'remote_translation' => [ 
			[ 'type' => I18n\Translator\Loader\DoctrineEntity::class ]
		]
	],
	'doctrine' => [
		'driver' => [
			__NAMESPACE__ . '_driver' => [
				'class' => AnnotationDriver::class, // use AnnotationDriver
				'cache' => 'array',
				'paths' => [__DIR__ . '/../src/Entity'] // entity path
			],
			'orm_default' => [
				'drivers' => [
					__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
				]
			]
		],

	],
];