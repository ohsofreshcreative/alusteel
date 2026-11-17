<!--- certs preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Certs</div>
			<span class="acf-preview__slug">acf/certs</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@include('partials.block-preview-intro', ['preview' => [
			'eyebrow' => $g_certs['subtitle'] ?? null,
			'header' => $g_certs['header'] ?? null,
			'html' => $g_certs['text'] ?? null,
			'image' => $g_certs['image'] ?? null,
			'flip' => $flip ?? false,
		]])
	</div>
</div>
