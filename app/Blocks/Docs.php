<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionBackgrounds;
use App\Support\SectionClasses;

class Docs extends Block
{
	public $name = 'Dokumenty do pobrania';
	public $description = 'docs - pliki do pobrania';
	public $slug = 'docs';
	public $category = 'formatting';
	public $icon = 'media-document';
	public $keywords = ['docs', 'dokumenty', 'pliki'];
	public $mode = 'edit';
	public $blockVersion = 3;
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
	];

	public function fields()
	{
		$docs = new FieldsBuilder('docs');

		$docs
			->setLocation('block', '==', 'acf/docs') // ważne!

			/*--- FIELDS ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_docs', ['label' => ''])
			->addImage('image', [
				'label' => 'Zdjęcie - tło',
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
			])
			->addText('subtitle', ['label' => 'Nadtytuł'])
			->addText('header', ['label' => 'Nagłówek'])
			->addRepeater('r_docs', [
				'label' => 'Dokumenty',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'button_label' => 'Dodaj dokument',
			])
			->addText('header', ['label' => 'Nagłówek'])
			->addFile('file', [
				'label' => 'Plik',
				'return_format' => 'array',
			])
			->addText('info', [
				'label' => 'Opis pliku',
				'instructions' => 'Np. „PDF - 1.2 MB”. Puste = typ i rozmiar pliku.',
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

		return $docs;
	}

	public function with(): array
	{
		$fields = [
			'g_docs' => get_field('g_docs'),
			'r_docs' => get_field('g_docs')['r_docs'] ?? [],

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
