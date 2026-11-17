<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionBackgrounds;
use App\Support\SectionClasses;

class Specification extends Block
{
	public $name = 'Specyfikacja techniczna';
	public $description = 'specification - tabela parametrów w dwóch kolumnach';
	public $slug = 'specification';
	public $category = 'formatting';
	public $icon = 'editor-table';
	public $keywords = ['specification', 'specyfikacja', 'tabela'];
	public $mode = 'edit';
	public $blockVersion = 3;
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
	];

	public function fields()
	{
		$specification = new FieldsBuilder('specification');

		$specification
			->setLocation('block', '==', 'acf/specification') // ważne!

			/*--- FIELDS ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_specification', ['label' => ''])
			->addText('subtitle', ['label' => 'Nadtytuł'])
			->addText('header', ['label' => 'Nagłówek'])
			->addRepeater('r_specification', [
				'label' => 'Wiersze',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'button_label' => 'Dodaj wiersz',
			])
			->addText('label', ['label' => 'Etykieta'])
			->addText('value', ['label' => 'Wartość'])
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

		return $specification;
	}

	public function with(): array
	{
		$fields = [
			'g_specification' => get_field('g_specification'),
			'r_specification' => get_field('g_specification')['r_specification'] ?? [],

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
