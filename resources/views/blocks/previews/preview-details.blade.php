<!--- details preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Detale z punktami</div>
			<span class="acf-preview__slug">acf/details</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_details['subtitle'] ?? null,
			'header' => $g_details['header'] ?? null,
			'html' => $g_details['text'] ?? null,
			'buttons' => [$g_details['button'] ?? null],
			'image' => $g_details['image'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_details ?? [],
			'previewLabel' => 'Punkty',
		])
	</div>
</div>
