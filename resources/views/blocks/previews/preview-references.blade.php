<!--- references preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Referencje</div>
			<span class="acf-preview__slug">acf/references</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_references['subtitle'] ?? null,
			'header' => $g_references['header'] ?? null,
			'html' => $g_references['text'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_references ?? [],
			'previewLabel' => 'Referencje',
		])
	</div>
</div>
