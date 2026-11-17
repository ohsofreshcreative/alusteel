<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PageFooter extends Field
{
	public function fields(): array
	{
		$pageFooter = new FieldsBuilder('page_footer_fields', [
			'title' => 'Ustawienia stopki',
			'style' => 'default',
			'position' => 'side',
		]);

		$pageFooter
			->setLocation('post_type', '==', 'page')
				->or('post_type', '==', 'offer');

		$pageFooter
			->addTrueFalse('footer_cta', [
				'label' => 'Pokaż CTA w stopce',
				'instructions' => 'Treść edytujemy w menu „Wezwanie do działania”.',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('no_footer_margin', [
				'label' => 'Brak marginesu footera',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return [$pageFooter];
	}
}