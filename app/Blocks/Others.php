<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionBackgrounds;
use App\Support\SectionClasses;

class Others extends Block
{
	public $name = 'Powiązane produkty';
	public $description = 'others - powiązane produkty oferty';
	public $slug = 'others';
	public $category = 'formatting';
	public $icon = 'products';
	public $keywords = ['others', 'powiązane', 'produkty'];
	public $mode = 'edit';
	public $blockVersion = 3;
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
	];

	public function fields()
	{
		$others = new FieldsBuilder('others');

		$others
			->setLocation('block', '==', 'acf/others') // ważne!

			/*--- FIELDS ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_others', ['label' => ''])
			->addText('subtitle', ['label' => 'Nadtytuł'])
			->addText('header', ['label' => 'Nagłówek'])
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

		return $others;
	}

	public function with(): array
	{
		$fields = [
			'g_others' => get_field('g_others'),
			'others' => $this->others(),

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

	/**
	 * Powiązane produkty: wpisy z tych samych kategorii (bez bieżącego), uzupełniane najnowszymi.
	 */
	protected function others(): array
	{
		$post_id = get_the_ID();
		$limit = 4;
		$args = [
			'post_type' => 'offer',
			'post_status' => 'publish',
			'posts_per_page' => $limit,
			'post__not_in' => $post_id ? [$post_id] : [],
			'no_found_rows' => true,
		];

		$terms = $post_id ? wp_get_post_terms($post_id, 'offer_category', ['fields' => 'ids']) : [];
		$posts = [];

		if (! empty($terms) && ! is_wp_error($terms)) {
			$posts = get_posts($args + ['tax_query' => [['taxonomy' => 'offer_category', 'terms' => $terms]]]);
		}

		if (count($posts) < $limit) {
			$exclude = array_merge($args['post__not_in'], wp_list_pluck($posts, 'ID'));
			$posts = array_merge($posts, get_posts(['posts_per_page' => $limit - count($posts), 'post__not_in' => $exclude] + $args));
		}

		return $posts;
	}
}
