<!--- history preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">History</div>
			<span class="acf-preview__slug">acf/history</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_history['subtitle'] ?? null,
			'header' => $g_history['header'] ?? null,
			'html' => $g_history['text'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_history ?? [],
			'previewLabel' => 'Etapy',
		])
	</div>
</div>
