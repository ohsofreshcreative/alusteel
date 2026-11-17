@extends('layouts.app')

@section('content')

@include('blocks.hero', [
	'section_id' => '',
	'section_class' => 'hero-archive',
	'sectionClass' => '',
	'background' => 'none',
])

@include('blocks.offer', [
	'variant' => 'tiles',
	'r_offer' => $tiles,
	'section_id' => 'kategorie',
	'section_class' => 'scroll-mt-32',
	'sectionClass' => '',
	'background' => 'none',
])

<!--- products --->
<section id="produkty" data-gsap-anim="section" @class(['b-products relative -smt scroll-mt-32', '-smb' => $featured])>
	<div class="__wrapper c-wide">
		@if (!$featured && (!empty($products['header']) || !empty($products['text'])))
		<div class="__top flex flex-col lg:flex-row lg:justify-between gap-6 lg:gap-10">
			@if (!empty($products['header']))
			<h2 data-gsap-element="header" class="text-h1 uppercase">{{ $products['header'] }}</h2>
			@endif
			@if (!empty($products['text']))
			<div data-gsap-element="txt" class="__txt lg:w-1/2 2xl:w-254 shrink-0">
				{!! $products['text'] !!}
			</div>
			@endif
		</div>
		@endif

		@if (count($chips) > 1)
		<nav class="__chips flex flex-wrap gap-6 mt-16" aria-label="Kategorie oferty">
			@foreach ($chips as $chip)
			<a href="{{ $chip['url'] }}" @class(['__chip px-6 py-2 transition-colors', 'is-active' => $chip['active']]) @if ($chip['active']) aria-current="page" @endif>
				{{ $chip['title'] }}
			</a>
			@endforeach
		</nav>
		@endif

		@if (have_posts() && $featured)
		<div class="__features flex flex-col gap-16 mt-16 first:mt-0">
			@while (have_posts())
			@php(the_post())
			<article @php(post_class('__feature bg-white p-8 grid grid-cols-1 lg:grid-cols-2 items-center gap-10 lg:gap-16'))>
				@if (has_post_thumbnail())
				<figure data-gsap-element="img" class="__img m-0">
					{!! wp_get_attachment_image(get_post_thumbnail_id(), 'large', false, ['class' => 'w-full h-auto object-contain', 'alt' => '']) !!}
				</figure>
				@endif
				<div class="__content flex flex-col">
					<h3 data-gsap-element="header" class="text-h2 uppercase m-header">{!! get_the_title() !!}</h3>
					@if (has_excerpt())
					<div data-gsap-element="txt" class="__txt">{!! wpautop(esc_html(get_the_excerpt())) !!}</div>
					@endif
					<div class="inline-buttons m-btn">
						<x-button :href="get_permalink()" variant="primary" data-gsap-element="btn">Zobacz produkt</x-button>
					</div>
				</div>
			</article>
			@endwhile
		</div>
		@elseif (have_posts())
		<div class="__cards grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-8">
			@while (have_posts())
			@php(the_post())
			@include('partials.content-offer')
			@endwhile
		</div>

		<div class="__pagination mt-10">
			{!! the_posts_pagination() !!}
		</div>
		@else
		<p class="mt-8">Brak produktów w tej kategorii.</p>
		@endif
	</div>
</section>

@endsection
