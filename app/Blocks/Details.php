<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionBackgrounds;
use App\Support\SectionClasses;

class Details extends Block
{
	public $name = 'Detale z punktami';
	public $description = 'details - zdjęcie w tle z numerowanymi punktami i listą';
	public $slug = 'details';
	public $category = 'formatting';
	public $icon = 'location';
	public $keywords = ['details', 'detale', 'punkty', 'hotspot'];
	public $mode = 'edit';
	public $blockVersion = 3;
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
	];

	public function fields()
	{
		$details = new FieldsBuilder('details');

		$details
			->setLocation('block', '==', 'acf/details') // ważne!

			/*--- FIELDS ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_details', ['label' => ''])
			->addImage('image', [
				'label' => 'Zdjęcie - tło',
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
			])
			->addText('subtitle', ['label' => 'Nadtytuł'])
			->addText('header', ['label' => 'Nagłówek'])
			->addWysiwyg('text', [
				'label' => 'Treść',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => true,
			])
			->addLink('button', [
				'label' => 'Przycisk',
				'return_format' => 'array',
			])
			->addRepeater('r_details', [
				'label' => 'Punkty',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'button_label' => 'Dodaj punkt',
			])
			->addText('header', ['label' => 'Nagłówek'])
			->addWysiwyg('text', [
				'label' => 'Treść',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => true,
			])
			->addNumber('pos_x', [
				'label' => 'Punkt na zdjęciu — X (%)',
				'min' => 0,
				'max' => 100,
				'step' => 1,
			])
			->addNumber('pos_y', [
				'label' => 'Punkt na zdjęciu — Y (%)',
				'min' => 0,
				'max' => 100,
				'step' => 1,
			])
			->endRepeater()
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

		return $details;
	}

	public function with(): array
	{
		$fields = [
			'g_details' => get_field('g_details'),
			'r_details' => get_field('g_details')['r_details'] ?? [],

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
