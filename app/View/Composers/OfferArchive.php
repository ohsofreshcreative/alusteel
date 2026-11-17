<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class OfferArchive extends Composer
{
	protected static $views = [
		'archive-offer',
	];

	public function with(): array
	{
		$options = get_field('g_ooffer', 'option') ?: [];
		$term = is_tax('offer_category') ? get_queried_object() : null;
		$parent = $term && $term->parent ? get_term($term->parent, 'offer_category') : $term;

		return [
			// Kategoria z pojedynczymi produktami (np. Zabudowy) — produkty jako zdjęcie + opis + przycisk
			'featured' => $term && get_field('products_featured', $term),
			'g_hero' => [
				'image' => $options['image'] ?? null,
				'title' => ($options['title'] ?? '') ?: post_type_archive_title('', false),
				'text' => $options['text'] ?? '',
			],
			'breadcrumbs' => $this->breadcrumbs($term),
			'tiles' => $this->tiles($options['r_tiles'] ?? [], $parent),
			'products' => [
				'header' => $term ? $term->name : ($options['header'] ?? ''),
				'text' => $term ? wpautop(term_description($term)) : ($options['products_text'] ?? ''),
			],
			'chips' => $this->chips($term, $parent),
			'g_octa' => get_field('g_octa', 'option'),
		];
	}

	/**
	 * Okruszki: Strona główna > Oferta [> kategoria nadrzędna > kategoria].
	 */
	protected function breadcrumbs($term): array
	{
		$items = [
			['title' => 'Strona główna', 'url' => home_url('/')],
			['title' => 'Oferta', 'url' => get_post_type_archive_link('offer')],
		];

		if ($term) {
			foreach (array_reverse(get_ancestors($term->term_id, 'offer_category', 'taxonomy')) as $ancestor_id) {
				$ancestor = get_term($ancestor_id, 'offer_category');
				$items[] = ['title' => $ancestor->name, 'url' => get_term_link($ancestor)];
			}
			$items[] = ['title' => $term->name, 'url' => get_term_link($term)];
		}

		return $items;
	}

	/**
	 * Kafelki w kształcie r_offer z bloku offer; aktywny dla bieżącej kategorii głównej.
	 */
	protected function tiles(array $rows, $parent): array
	{
		return collect($rows)
			->filter(fn ($row) => ! empty($row['term']) && ! is_wp_error($row['term']))
			->map(fn ($row) => [
				'image' => $row['image'] ?? null,
				'header' => $row['term']->name,
				// Kotwica: po przejściu do kategorii strona przewija się do kafelków
				'button' => ['url' => get_term_link($row['term']) . '#kategorie', 'title' => $row['term']->name],
				'active' => $parent && $parent->term_id === $row['term']->term_id,
			])
			->values()
			->all();
	}

	/**
	 * Chipy: „Wszystkie” + podkategorie wybranej kategorii albo kategorie główne na /offer/.
	 */
	protected function chips($term, $parent): array
	{
		$terms = get_terms([
			'taxonomy' => 'offer_category',
			'parent' => $parent ? $parent->term_id : 0,
			'hide_empty' => false,
		]);

		$chips = [[
			'title' => 'Wszystkie',
			'url' => ($parent ? get_term_link($parent) : get_post_type_archive_link('offer')) . '#produkty',
			'active' => ! $term || $term->term_id === $parent->term_id,
		]];

		foreach (is_wp_error($terms) ? [] : $terms as $item) {
			$chips[] = [
				'title' => $item->name,
				'url' => get_term_link($item) . '#produkty',
				'active' => $term && $term->term_id === $item->term_id,
			];
		}

		return $chips;
	}
}
