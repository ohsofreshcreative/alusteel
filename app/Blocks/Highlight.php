<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionBackgrounds;
use App\Support\SectionClasses;

class Highlight extends Block
{
	public $name = 'Zdjęcie w tle z listą';
	public $description = 'highlight - treść na zdjęciu z gradientem i lista pozycji';
	public $slug = 'highlight';
	public $category = 'formatting';
	public $icon = 'format-image';
	public $keywords = ['highlight', 'lista', 'zdjecie'];
	public $mode = 'edit';
	public $blockVersion = 3;
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
	];

	public function fields()
	{
		$highlight = new FieldsBuilder('highlight');

		$highlight
			->setLocation('block', '==', 'acf/highlight') // ważne!

			/*--- FIELDS ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_highlight', ['label' => ''])
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
			->addRepeater('r_highlight', [
				'label' => 'Pozycje',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'button_label' => 'Dodaj pozycję',
			])
			->addText('header', ['label' => 'Nagłówek'])
			->addWysiwyg('text', [
				'label' => 'Treść (opcjonalnie)',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => true,
			])
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

		return $highlight;
	}

	public function with(): array
	{
		$fields = [
			'g_highlight' => get_field('g_highlight'),
			'r_highlight' => get_field('g_highlight')['r_highlight'] ?? [],

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
