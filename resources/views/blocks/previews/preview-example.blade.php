<!--- example preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Przykładowe wyposażenie</div>
			<span class="acf-preview__slug">acf/example</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_example['subtitle'] ?? null,
			'header' => $g_example['header'] ?? null,
			'html' => $g_example['text'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_example ?? [],
			'previewLabel' => 'Kafle',
		])
	</div>
</div>
