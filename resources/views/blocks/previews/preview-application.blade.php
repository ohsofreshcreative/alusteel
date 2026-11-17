<!--- application preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Zastosowanie</div>
			<span class="acf-preview__slug">acf/application</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_application['subtitle'] ?? null,
			'header' => $g_application['header'] ?? null,
			'html' => $g_application['text'] ?? null,
			'buttons' => [$g_application['button'] ?? null],
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_application ?? [],
			'previewLabel' => 'Kafelki',
		])
	</div>
</div>
