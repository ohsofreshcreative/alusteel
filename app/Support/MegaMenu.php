<?php

namespace App\Support;

/**
 * Przygotowuje dane mega menu z elementów menu WordPress.
 *
 * Podelement wskazujący kategorię oferty → lista produktów (kolumny = podkategorie).
 * Każdy inny podelement (pojedyncza podstrona oferty, strona, link) → nagłówek, opis i odnośnik.
 */
class MegaMenu
{
	/**
	 * @param \WP_Post $item element główny menu
	 * @param array<int, \WP_Post> $children bezpośrednie podelementy
	 */
	public static function data($item, array $children): array
	{
		return [
			'item' => $item,
			'panels' => array_values(array_map([self::class, 'panel'], $children)),
			'promo' => get_field('g_megamenu_promo', $item->ID) ?: [],
		];
	}

	protected static function panel($child): array
	{
		$panel = [
			'title' => $child->title,
			'url' => $child->url,
			'current' => in_array('current-menu-item', (array) $child->classes, true),
			'icon' => self::icon($child),
			'columns' => [],
			'text' => '',
		];

		if ($child->type === 'taxonomy' && $child->object === 'offer_category') {
			$panel['columns'] = self::productColumns((int) $child->object_id);
		}

		if (empty($panel['columns'])) {
			$panel['text'] = get_field('menu_text', $child->ID)
				?: ($child->type === 'post_type' ? get_the_excerpt((int) $child->object_id) : '');
		}

		return $panel;
	}

	protected static function icon($child): ?int
	{
		$icon = get_field('menu_icon', $child->ID);

		if (empty($icon['ID']) && $child->type === 'post_type' && $child->object === 'offer') {
			$icon = get_field('offer_icon', (int) $child->object_id);
		}

		return !empty($icon['ID']) ? (int) $icon['ID'] : null;
	}

	/**
	 * Kolumny produktów: jedna na podkategorię, a gdy podkategorii brak — jedna z produktami kategorii.
	 */
	protected static function productColumns(int $termId): array
	{
		$subterms = get_terms([
			'taxonomy' => 'offer_category',
			'parent' => $termId,
			'hide_empty' => true,
		]);

		$sources = !empty($subterms) && !is_wp_error($subterms)
			? array_map(fn ($term) => ['title' => $term->name, 'term' => $term->term_id], $subterms)
			: [['title' => '', 'term' => $termId]];

		$columns = [];

		foreach ($sources as $source) {
			$products = get_posts([
				'post_type' => 'offer',
				'posts_per_page' => -1,
				'orderby' => ['menu_order' => 'ASC', 'title' => 'ASC'],
				'no_found_rows' => true,
				'tax_query' => [[
					'taxonomy' => 'offer_category',
					'terms' => $source['term'],
				]],
			]);

			if (empty($products)) {
				continue;
			}

			$columns[] = [
				'title' => $source['title'],
				'items' => array_map(fn ($post) => [
					'title' => get_the_title($post),
					'url' => get_permalink($post),
				], $products),
			];
		}

		return $columns;
	}
}
