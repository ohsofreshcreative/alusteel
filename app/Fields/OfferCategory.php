<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class OfferCategory extends Field
{
	public function fields(): array
	{
		$offerCategory = new FieldsBuilder('offer_category_fields', [
			'title' => 'Ustawienia kategorii',
			'style' => 'seamless',
		]);

		$offerCategory
			->setLocation('taxonomy', '==', 'offer_category')
			->addTrueFalse('products_featured', [
				'label' => 'Produkty jako opisy',
				'instructions' => 'Zamiast kafelków każdy produkt pokaże się jako zdjęcie (obrazek wyróżniający), opis (zajawka) i przycisk. Dla kategorii z pojedynczymi produktami, np. Zabudowy specjalne, Przyczepy.',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return [$offerCategory];
	}
}
