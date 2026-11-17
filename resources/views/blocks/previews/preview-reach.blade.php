<!--- reach preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Kontakt z formularzem</div>
			<span class="acf-preview__slug">acf/reach</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'header' => $g_reach['header'] ?? null,
			'html' => $g_reach['text'] ?? null,
			'image' => $g_reach['image'] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_reach ?? [],
			'previewLabel' => 'Kontakty',
			'previewTitleKey' => 'value',
		])
	</div>
</div>
