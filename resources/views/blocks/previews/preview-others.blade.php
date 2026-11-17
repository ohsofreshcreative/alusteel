<!--- others preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Powiązane produkty</div>
			<span class="acf-preview__slug">acf/others</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_others['subtitle'] ?? null,
			'header' => $g_others['header'] ?? null,
			'flip' => $flip ?? false,
		]])
	</div>
</div>
