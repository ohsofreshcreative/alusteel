<!--- bar preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Pasek cech</div>
			<span class="acf-preview__slug">acf/bar</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [

			'flip' => $flip ?? false,
		]])
		@include('partials.block-preview-items', [
			'previewItems' => $r_bar ?? [],
			'previewLabel' => 'Cechy',
			'previewIcons' => true,
		])
	</div>
</div>
