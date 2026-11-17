<!--- duo preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Dwa duże kafelki</div>
			<span class="acf-preview__slug">acf/duo</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_duo['subtitle'] ?? null,
			'header' => $g_duo['header'] ?? null,
			'html' => $g_duo['text'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_duo ?? [],
			'previewLabel' => 'Kafelki',
		])
	</div>
</div>
