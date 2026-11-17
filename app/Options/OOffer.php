<?php

namespace App\Options;

use Log1x\AcfComposer\Options;
use StoutLogic\AcfBuilder\FieldsBuilder;

class OOffer extends Options
{
	public $name = 'Archiwum oferty';
	public $slug = 'ooffer';
	public $title = 'Archiwum oferty';
	public $parent = 'edit.php?post_type=offer';
	public $capability = 'edit_posts';
	public $redirect = false;

	public function fields(): FieldsBuilder
	{
		$ooffer = new FieldsBuilder('ooffer');

		$ooffer
			->addGroup('g_ooffer', ['label' => ''])
			->addImage('image', [
				'label'         => 'Hero - obraz tła',
				'return_format' => 'array',
				'preview_size'  => 'medium',
			])
			->addText('title', ['label' => 'Hero - nagłówek'])
			->addWysiwyg('text', [
				'label'        => 'Hero - treść',
				'tabs'         => 'all',
				'toolbar'      => 'full',
				'media_upload' => true,
			])
			->addRepeater('r_tiles', [
				'label'        => 'Kafelki kategorii',
				'instructions' => 'Kafelek prowadzi do kategorii oferty i używa jej nazwy.',
				'layout'       => 'table',
				'button_label' => 'Dodaj kafelek',
			])
			->addTaxonomy('term', [
				'label'         => 'Kategoria',
				'taxonomy'      => 'offer_category',
				'field_type'    => 'select',
				'return_format' => 'object',
				'add_term'      => 0,
				'save_terms'    => 0,
				'load_terms'    => 0,
			])
			->addImage('image', [
				'label'         => 'Obraz',
				'return_format' => 'array',
				'preview_size'  => 'thumbnail',
			])
			->endRepeater()
			->addText('header', [
				'label'        => 'Produkty - nagłówek',
				'instructions' => 'Wyświetlany na liście wszystkich produktów (bez wybranej kategorii).',
			])
			->addWysiwyg('products_text', [
				'label'        => 'Produkty - treść',
				'tabs'         => 'all',
				'toolbar'      => 'full',
				'media_upload' => true,
			])
			->endGroup();

		return $ooffer;
	}
}
