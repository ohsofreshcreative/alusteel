<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class MenuItemFields extends Field
{
	public function fields(): array
	{
		$menuItem = new FieldsBuilder('menu_item_fields', [
			'title' => 'Mega menu',
			'style' => 'seamless',
		]);

		$menuItem
			->setLocation('nav_menu_item', '==', 'location/primary_navigation')
			->addTrueFalse('megamenu', [
				'label' => 'Mega menu',
				'instructions' => 'Tylko dla elementu głównego (np. „Oferta”). Podelementy pokażą się jako lista po lewej stronie mega menu.',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addGroup('g_megamenu_promo', [
				'label' => 'Baner w mega menu',
			])
				->conditional('megamenu', '==', '1')
				->addImage('image', [
					'label' => 'Zdjęcie',
					'return_format' => 'array',
					'preview_size' => 'thumbnail',
				])
				->addText('header', ['label' => 'Nagłówek'])
				->addLink('button', [
					'label' => 'Przycisk',
					'return_format' => 'array',
				])
			->endGroup()
			->addImage('menu_icon', [
				'label' => 'Ikona',
				'instructions' => 'Ikona w lewej kolumnie mega menu. Dla produktu z oferty domyślnie używana jest jego ikona.',
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
			])
			->addWysiwyg('menu_text', [
				'label' => 'Opis w mega menu',
				'instructions' => 'Dla pojedynczej podstrony (np. Zabudowy). Puste = zajawka (excerpt) podstrony. Dla kategorii oferty wyświetla się lista produktów.',
				'tabs' => 'all',
				'toolbar' => 'basic',
				'media_upload' => false,
			]);

		return [$menuItem];
	}
}
