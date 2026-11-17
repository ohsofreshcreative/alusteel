<!--- works preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Realizacje - galeria</div>
			<span class="acf-preview__slug">acf/works</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_works['subtitle'] ?? null,
			'header' => $g_works['header'] ?? null,
			'buttons' => [$g_works['button'] ?? null],
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_works ?? [],
			'previewLabel' => 'Zdjęcia',
		])
	</div>
</div>
