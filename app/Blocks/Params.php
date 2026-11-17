<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionBackgrounds;
use App\Support\SectionClasses;

class Params extends Block
{
	public $name = 'Parametry z galerią';
	public $description = 'params - galeria i najważniejsze parametry';
	public $slug = 'params';
	public $category = 'formatting';
	public $icon = 'images-alt2';
	public $keywords = ['params', 'parametry', 'galeria'];
	public $mode = 'edit';
	public $blockVersion = 3;
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
	];

	public function fields()
	{
		$params = new FieldsBuilder('params');

		$params
			->setLocation('block', '==', 'acf/params') // ważne!

			/*--- FIELDS ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_params', ['label' => ''])
			->addGallery('gallery', [
				'label' => 'Galeria',
				'preview_size' => 'medium',
				'library' => 'all',
				'return_format' => 'array',
			])
			->addText('header', ['label' => 'Nagłówek'])
			->addRepeater('r_params', [
				'label' => 'Parametry',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'button_label' => 'Dodaj parametr',
			])
			->addImage('icon', [
				'label' => 'Ikona',
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
			])
			->addText('label', ['label' => 'Etykieta'])
			->addText('value', ['label' => 'Wartość'])
			->endRepeater()
			->addLink('button', [
				'label' => 'Przycisk',
				'return_format' => 'array',
			])
			->endGroup()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
			])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('wide', [
				'label' => 'Szeroka kolumna',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('nomt', [
				'label' => 'Usunięcie marginesu górnego',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('gap', [
				'label' => 'Większy odstęp',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addSelect('background', [
				'label' => 'Kolor tła',
				'choices' => SectionBackgrounds::choices(),
				'default_value' => 'none',
				'ui' => 0, // Ulepszony interfejs
				'allow_null' => 0,
			]);

		return $params;
	}

	public function with(): array
	{
		$fields = [
			'g_params' => get_field('g_params'),
			'r_params' => get_field('g_params')['r_params'] ?? [],

			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),

			'flip' => (bool) get_field('flip'),
			'wide' => (bool) get_field('wide'),
			'nomt' => (bool) get_field('nomt'),
			'gap' => (bool) get_field('gap'),

			'background' => get_field('background') ?: get_field('default_block_background', 'option') ?: 'none',
		];

		$fields['sectionClass'] = SectionClasses::fromMap($fields, [
			'flip' => 'order-flip',
			'wide' => 'wide',
			'nomt' => '!mt-0',
			'gap' => 'wider-gap',
		]);

		return $fields;
	}
}
