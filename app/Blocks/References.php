<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionBackgrounds;
use App\Support\SectionClasses;

class References extends Block
{
	public $name = 'Referencje';
	public $description = 'references - karty dokumentów referencyjnych';
	public $slug = 'references';
	public $category = 'formatting';
	public $icon = 'media-document';
	public $keywords = ['references', 'referencje', 'dokumenty'];
	public $mode = 'edit';
	public $blockVersion = 3;
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
	];

	public function fields()
	{
		$references = new FieldsBuilder('references');

		$references
			->setLocation('block', '==', 'acf/references') // ważne!

			/*--- FIELDS ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_references', ['label' => ''])
			->addText('subtitle', ['label' => 'Nadtytuł'])
			->addText('header', ['label' => 'Nagłówek'])
			->addWysiwyg('text', [
				'label' => 'Treść',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => true,
			])
			->addText('more', [
				'label' => 'Tekst linku w kartach',
				'default_value' => 'Zobacz pełną referencję',
			])
			->addRepeater('r_references', [
				'label' => 'Referencje',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'button_label' => 'Dodaj referencję',
			])
			->addImage('image', [
				'label' => 'Skan dokumentu',
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
			])
			->addText('header', ['label' => 'Nagłówek'])
			->addText('subtitle', ['label' => 'Podtytuł (np. produkt)'])
			->addFile('file', [
				'label' => 'Plik referencji (opcjonalnie)',
				'instructions' => 'Bez pliku link otwiera pełny skan dokumentu.',
				'return_format' => 'array',
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

		return $references;
	}

	public function with(): array
	{
		$fields = [
			'g_references' => get_field('g_references'),
			'r_references' => get_field('g_references')['r_references'] ?? [],

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
