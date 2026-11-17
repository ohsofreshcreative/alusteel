<!--- presentation preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Prezentacja z galerią</div>
			<span class="acf-preview__slug">acf/presentation</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_presentation['subtitle'] ?? null,
			'header' => $g_presentation['header'] ?? null,
			'html' => $g_presentation['text'] ?? null,
			'buttons' => [$g_presentation['button'] ?? null],
			'image' => $g_presentation['image'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => array_map(fn ($image) => ['image' => $image], $g_presentation['gallery'] ?? []),
			'previewLabel' => 'Zdjęcia',
		])
	</div>
</div>
