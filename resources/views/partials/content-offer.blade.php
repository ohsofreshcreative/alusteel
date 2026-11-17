@php
$compact = $compact ?? false;
$offerTerms = $compact ? get_the_terms(get_the_ID(), 'offer_category') : [];
$offerTerm = !empty($offerTerms) && !is_wp_error($offerTerms) ? $offerTerms[0] : null;
// W karcie powiązanych produktów pokazujemy kategorię główną
while ($offerTerm && $offerTerm->parent) { $offerTerm = get_term($offerTerm->parent, 'offer_category'); }
@endphp
<article @php(post_class('__card bg-white'))>
	<a href="{{ get_permalink() }}" @class([
		'flex flex-col h-full',
		'gap-10 p-8' => !$compact,
		'gap-6 px-6 py-10 text-center' => $compact,
	])>
		@if (has_post_thumbnail())
		<figure @class(['__img flex items-center justify-center m-0', 'h-53' => !$compact, 'h-31.5' => $compact])>
			{!! wp_get_attachment_image(get_post_thumbnail_id(), 'medium_large', false, ['class' => 'h-full w-auto object-contain', 'alt' => '']) !!}
		</figure>
		@endif
		<div @class(['__txt flex flex-col', 'mt-auto' => !$compact])>
			<p @class(['uppercase m-header', 'text-h6' => !$compact, 'text-h5' => $compact])>{!! get_the_title() !!}</p>
			@if ($compact)
			@if ($offerTerm)
			<p class="__term">{{ $offerTerm->name }}</p>
			@endif
			@else
			<svg class="self-end" xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 17" fill="none" aria-hidden="true">
				<path d="M1 8.5H23M23 8.5L15.5 1M23 8.5L15.5 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
			</svg>
			@endif
		</div>
	</a>
</article>
