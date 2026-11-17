<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'*', // działa globalnie
	];

	/**
	 * Dane dostępne we wszystkich widokach Blade.
	 */
	public function with(): array
	{
		return [
			'siteName' => $this->siteName(),
			'logo' => get_field('logo', 'option'),
			'logo_footer' => get_field('logo_footer', 'option'),
			'footer_contact' => get_field('footer_contact', 'option'),
			'socials' => get_field('socials', 'option'),
			'footer_cta' => $this->footerCta(),
		];
	}

	/**
	 * CTA w stopce z opcji „Wezwanie do działania”.
	 * Pokazywane domyślnie — strona może je wyłączyć polem `footer_cta`
	 * (null = pole niezapisane, np. starsze strony lub inne typy treści).
	 */
	public function footerCta(): ?array
	{
		if (is_singular() && get_field('footer_cta', get_queried_object_id()) === false) {
			return null;
		}

		return get_field('g_octa', 'option') ?: null;
	}

	/**
	 * Zwraca nazwę strony.
	 */
	public function siteName(): string
	{
		return get_bloginfo('name', 'display');
	}
}
