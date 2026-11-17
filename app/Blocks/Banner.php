<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionBackgrounds;
use App\Support\SectionClasses;

class Banner extends Block
{
	public $name = 'Hero - Podstrona';
	public $description = 'banner - hero dla podstron';
	public $slug = 'banner';
	public $category = 'formatting';
	public $icon = 'align-full-width';
	public $keywords = ['tresc', 'zdjecie', 'podstrona', 'hero'];
	public $mode = 'edit';
	public $blockVersion = 3;
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
	];

	public function fields()
	{
		$banner = new FieldsBuilder('banner');

		$banner
			->setLocation('block', '==', 'acf/banner') // ważne!
			/*--- TAB #1 ---*/
			->addTab('Treść', ['placement' => 'top'])
			->addGroup('g_banner', ['label' => 'banner'])
			->addImage('image', [
				'label' => 'Zdjęcie - tło',
				'instructions' => 'Opcjonalne. Ze zdjęciem baner ma ciemną nakładkę i biały tekst.',
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
			])
			->addText('title', ['label' => 'Tytuł'])
			->addWysiwyg('text', [
				'label' => 'Treść',
				'instructions' => 'Opcjonalny opis pod tytułem.',
				'tabs' => 'all', // 'visual', 'text', 'all'
				'toolbar' => 'full', // 'basic', 'full'
				'media_upload' => true,
			])
			->addLink('button', [
				'label' => 'Przycisk',
				'return_format' => 'array',
			])
			->addLink('button2', [
				'label' => 'Przycisk 2',
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
			->addTrueFalse('breadcrumbs', [
				'label' => 'Okruszki',
				'instructions' => 'Strona główna > strony nadrzędne > bieżąca strona',
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
			->addSelect('background', [
				'label' => 'Kolor tła',
				'choices' => SectionBackgrounds::choices(),
				'default_value' => 'section-gradient',
				'ui' => 0, // Ulepszony interfejs
				'allow_null' => 0,
			]);

		return $banner;
	}

	public function with(): array
	{
		$fields = [
			'g_banner' => get_field('g_banner'),

			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),

			'wide' => (bool) get_field('wide'),
			'nomt' => (bool) get_field('nomt'),

			'background' => get_field('background') ?: 'none',
		];

		$fields['breadcrumbs'] = get_field('breadcrumbs') ? $this->breadcrumbs() : [];

		$fields['sectionClass'] = SectionClasses::fromMap($fields, [
			'wide' => 'wide',
			'nomt' => '!mt-0',
		]);

		return $fields;
	}

	/**
	 * Okruszki w formacie widoku hero: Strona główna [> archiwum CPT] > strony nadrzędne > bieżąca strona.
	 */
	protected function breadcrumbs(): array
	{
		$post_id = get_the_ID();

		if (! $post_id) {
			return [];
		}

		$items = [['title' => 'Strona główna', 'url' => home_url('/')]];

		$post_type = get_post_type_object(get_post_type($post_id));

		if ($post_type && $post_type->has_archive && is_singular($post_type->name)) {
			$items[] = ['title' => $post_type->labels->name, 'url' => get_post_type_archive_link($post_type->name)];
		}

		foreach (array_reverse(get_post_ancestors($post_id)) as $ancestor_id) {
			$items[] = ['title' => get_the_title($ancestor_id), 'url' => get_permalink($ancestor_id)];
		}

		$items[] = ['title' => get_the_title($post_id), 'url' => get_permalink($post_id)];

		return $items;
	}
}
