<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionBackgrounds;
use App\Support\SectionClasses;

class Reach extends Block
{
	public $name = 'Kontakt z formularzem';
	public $description = 'reach - dane kontaktowe i formularz';
	public $slug = 'reach';
	public $category = 'formatting';
	public $icon = 'email';
	public $keywords = ['reach', 'kontakt', 'formularz'];
	public $mode = 'edit';
	public $blockVersion = 3;
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
	];

	public function fields()
	{
		$reach = new FieldsBuilder('reach');

		$reach
			->setLocation('block', '==', 'acf/reach') // ważne!

			/*--- FIELDS ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_reach', ['label' => ''])
			->addImage('image', [
				'label' => 'Zdjęcie - tło formularza',
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
			])
			->addText('header', ['label' => 'Nagłówek'])
			->addWysiwyg('text', [
				'label' => 'Adres',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => true,
			])
			->addRepeater('r_reach', [
				'label' => 'Kontakty',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'button_label' => 'Dodaj kontakt',
			])
			->addSelect('type', [
				'label' => 'Typ',
				'choices' => ['phone' => 'Telefon', 'email' => 'E-mail'],
				'default_value' => 'phone',
			])
			->addText('value', ['label' => 'Wartość'])
			->endRepeater()
			->addText('form_header', ['label' => 'Nagłówek formularza'])
			->addText('shortcode', [
				'label' => 'Shortcode formularza',
				'instructions' => 'Np. [contact-form-7 id="..."]',
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

		return $reach;
	}

	public function with(): array
	{
		$fields = [
			'g_reach' => get_field('g_reach'),
			'r_reach' => get_field('g_reach')['r_reach'] ?? [],

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
