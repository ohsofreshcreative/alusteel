<!--- whyus preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Dlaczego my - zakładki</div>
			<span class="acf-preview__slug">acf/whyus</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_whyus['subtitle'] ?? null,
			'header' => $g_whyus['header'] ?? null,
			'subheader' => $g_whyus['title'] ?? null,
			'html' => $g_whyus['text'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_whyus ?? [],
			'previewLabel' => 'Punkty',
		])
	</div>
</div>
