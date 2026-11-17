<!--- params preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Parametry z galerią</div>
			<span class="acf-preview__slug">acf/params</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'header' => $g_params['header'] ?? null,
			'buttons' => [$g_params['button'] ?? null],
			'image' => $g_params['gallery'][0] ?? null,
			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_params ?? [],
			'previewLabel' => 'Parametry',
			'previewIcons' => true,
		])
	</div>
</div>
