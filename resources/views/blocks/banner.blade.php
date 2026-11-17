<!--- banner --->

@if (!empty($block->preview))
@include('blocks.previews.preview-banner')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-banner relative -spt overflow-visible' ,
	'banner-image' => !empty($g_banner['image']['ID']),
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	@if (!empty($g_banner['image']['ID']))
	{{-- Wariant ze zdjęciem w tle (nakładka, biały tekst, okruszki); bez zdjęcia render poniżej bez zmian --}}
	<figure data-gsap-element="img" class="__img absolute inset-0 m-0">
		{!! wp_get_attachment_image($g_banner['image']['ID'], 'full', false, ['class' => 'w-full h-full object-cover']) !!}
	</figure>
	<div class="__overlay absolute inset-0 z-1 pointer-events-none bg-linear-to-r from-black to-transparent after:absolute after:inset-0 after:bg-linear-to-t after:from-primary-dark/64 after:to-transparent after:to-50%"></div>

	<div class="__wrapper c-wide relative z-10 pt-2">
		<div class="__content flex flex-col gap-6 w-full lg:w-216">
			@if (!empty($breadcrumbs))
			<nav class="__bread flex flex-wrap items-center gap-2 text-white" aria-label="Okruszki">
				@foreach ($breadcrumbs as $crumb)
				@if ($loop->last)
				<span aria-current="page" class="text-primary-400">{{ $crumb['title'] }}</span>
				@else
				<a href="{{ $crumb['url'] }}" class="!text-white">{{ $crumb['title'] }}</a>
				<svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none" aria-hidden="true">
					<path d="M1 1L4 4L1 7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
				@endif
				@endforeach
			</nav>
			@endif
			<div class="__inside py-26">
				<h1 data-gsap-element="header" class="text-h1 uppercase text-white m-header">
					{{ $g_banner['title'] }}
				</h1>
				@if (!empty($g_banner['text']))
				<div data-gsap-element="text" class="__txt text-white">
					{!! $g_banner['text'] !!}
				</div>
				@endif
				@if (!empty($g_banner['button']['url']) || !empty($g_banner['button2']['url']))
				<div class="inline-buttons m-btn">
					@if (!empty($g_banner['button']['url']))
					<x-button :href="$g_banner['button']['url']" variant="primary" class="!rounded-none" data-gsap-element="btn">
						{{ $g_banner['button']['title'] }}
					</x-button>
					@endif
					@if (!empty($g_banner['button2']['url']))
					<x-button :href="$g_banner['button2']['url']" variant="white" class="!rounded-none" data-gsap-element="btn">
						{{ $g_banner['button2']['title'] }}
					</x-button>
					@endif
				</div>
				@endif
			</div>
		</div>
	</div>
	@else
	<div class="__wrapper c-main relative z-10 -spt">
		<div class="__content max-w-3xl">
			<h1 data-gsap-element="header" class="text-h2 m-header">
				{{ $g_banner['title'] }}
			</h1>
			@if (!empty($g_banner['text']))
			<div data-gsap-element="text" class="__txt">
				{!! $g_banner['text'] !!}
			</div>
			@endif
		</div>
	</div>
	@endif
</section>

@endif
