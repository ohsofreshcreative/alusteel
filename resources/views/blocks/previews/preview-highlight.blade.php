<!--- highlight preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Zdjęcie w tle z listą</div>
			<span class="acf-preview__slug">acf/highlight</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_highlight['subtitle'] ?? null,
			'header' => $g_highlight['header'] ?? null,
			'html' => $g_highlight['text'] ?? null,
			'buttons' => [$g_highlight['button'] ?? null],
			'image' => $g_highlight['image'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_highlight ?? [],
			'previewLabel' => 'Pozycje',
		])
	</div>
</div>
