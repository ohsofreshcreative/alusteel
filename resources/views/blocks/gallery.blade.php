@if (!empty($block->preview))
@include('blocks.previews.preview-gallery')
@else

@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $nolist ? ' no-list' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}
@endphp

<!-- gallery --->

@if (!empty($r_gallery))
{{-- Wariant z kategoriami (makieta „Galeria”): chipy + filtrowanie Alpine. Każda kategoria to osobny .lightbox-gallery,
	więc baguetteBox przewija tylko zdjęcia widocznej kategorii. Bez kategorii zostaje dotychczasowy układ niżej. --}}
<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-gallery gallery-filter relative -smt {{ $sectionClass }} {{ $section_class }}" x-data="{ active: 'all' }">
	<div @class(["__wrapper c-wide flex flex-col gap-6", "pt-10" => $nomt])>
		@if (!empty($g_gallery['header']))
		<h2 data-gsap-element="header" class="text-h2 uppercase">{{ $g_gallery['header'] }}</h2>
		@endif

		<div class="__chips flex flex-wrap gap-6" role="group" aria-label="Filtruj zdjęcia">
			<button type="button" class="__chip is-active px-6 py-2 border border-secondary-50 bg-white text-secondary-900 cursor-pointer disabled:cursor-default" @click="active = 'all'" :class="{ 'is-active': active === 'all' }" aria-pressed="true" :aria-pressed="(active === 'all').toString()">{{ $g_gallery['all_label'] ?: 'Wszystkie' }}</button>
			@foreach ($r_gallery as $category)
			@if (!empty($category['name']))
			<button type="button" class="__chip px-6 py-2 border border-secondary-50 bg-white text-secondary-900 cursor-pointer disabled:cursor-default" @click="active = 'c{{ $loop->index }}'" :class="{ 'is-active': active === 'c{{ $loop->index }}' }" aria-pressed="false" :aria-pressed="(active === 'c{{ $loop->index }}').toString()" @if (empty($category['images'])) disabled @endif>{{ $category['name'] }}</button>
			@endif
			@endforeach
		</div>

		@if (!empty($g_gallery['gallery']))
		<div class="__grid lightbox-gallery grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" x-show="active === 'all'" data-gsap-element="images">
			@foreach ($g_gallery['gallery'] as $image)
			<a href="{{ $image['url'] }}" class="block">
				{!! wp_get_attachment_image($image['ID'], 'large', false, ['class' => 'w-full aspect-48/35 object-cover', 'loading' => 'lazy']) !!}
			</a>
			@endforeach
		</div>
		@endif
		@foreach ($r_gallery as $category)
		@if (!empty($category['images']))
		<div class="__grid lightbox-gallery grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" x-show="active === 'c{{ $loop->index }}'" x-cloak>
			@foreach ($category['images'] as $image)
			<a href="{{ $image['url'] }}" class="block">
				{!! wp_get_attachment_image($image['ID'], 'large', false, ['class' => 'w-full aspect-48/35 object-cover', 'loading' => 'lazy']) !!}
			</a>
			@endforeach
		</div>
		@endif
		@endforeach
	</div>
</section>
@else
<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-gallery relative -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main">
		<h2 data-gsap-element="header" class="m-header">{{ $g_gallery['header'] }}</h2>

		@if (!empty($g_gallery['gallery']))
		<div data-gsap-element="images" class="lightbox-gallery grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
			@foreach ($g_gallery['gallery'] as $image)
		
            <a href="{{ $image['url'] }}">
                <img class="img-m w-full radius object-cover" src="{{ $image['sizes']['large'] ?? $image['url'] }}" alt="{{ $image['alt'] ?? '' }}">
            </a>
			@endforeach
		</div>
		@endif

	</div>
</section>
@endif

@endif
