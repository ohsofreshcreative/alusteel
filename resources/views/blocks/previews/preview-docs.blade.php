<!--- docs preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Dokumenty do pobrania</div>
			<span class="acf-preview__slug">acf/docs</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_docs['subtitle'] ?? null,
			'header' => $g_docs['header'] ?? null,
			'image' => $g_docs['image'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_docs ?? [],
			'previewLabel' => 'Dokumenty',
		])
	</div>
</div>
