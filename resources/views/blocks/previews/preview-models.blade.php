<!--- models preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Modele produktu</div>
			<span class="acf-preview__slug">acf/models</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_models['subtitle'] ?? null,
			'header' => $g_models['header'] ?? null,
			'html' => $g_models['text'] ?? null,
			'buttons' => [$g_models['button'] ?? null],
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_models ?? [],
			'previewLabel' => 'Modele',
		])
	</div>
</div>
