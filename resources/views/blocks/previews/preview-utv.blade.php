<!--- utv preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Baner ze zdjęciem w tle</div>
			<span class="acf-preview__slug">acf/utv</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_utv['subtitle'] ?? null,
			'header' => $g_utv['header'] ?? null,
			'html' => $g_utv['text'] ?? null,
			'buttons' => [$g_utv['button'] ?? null],
			'image' => $g_utv['image'] ?? null,
			'flip' => $flip ?? false,
		]])
	</div>
</div>
