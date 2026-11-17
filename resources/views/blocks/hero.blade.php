<!-- hero --->

@if (!empty($block->preview))
@include('blocks.previews.preview-hero')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-hero relative bg-main -spt overflow-visible' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	@if (!empty($g_hero['video']))
	<video class="absolute inset-0 w-full h-full object-cover z-0" autoplay loop muted playsinline>
		<source src="{{ $g_hero['video'] }}" type="video/mp4">
	</video>
	
	@elseif(!empty($g_hero['image']))
	<figure data-gsap-element="img" class="absolute inset-0 w-full h-full z-0 m-0">
		<picture class="w-full h-full">
			<img src="{{ $g_hero['image']['url'] }}" alt="{{ $g_hero['image']['alt'] }}" class="w-full h-full object-cover" />
		</picture>
	</figure>
	@endif

	@if (!empty($g_hero['video']) || !empty($g_hero['image']))
	<div @class(['__overlay absolute inset-0 z-1 pointer-events-none bg-linear-to-r to-transparent after:absolute after:inset-0',
		'from-black after:bg-linear-to-t after:from-primary-dark after:to-transparent after:to-50%' => str_contains($section_class ?? '', 'hero-archive'),
		'bg-black/20 from-primary-dark after:bg-linear-to-b after:from-transparent after:from-47% after:to-secondary-900' => !str_contains($section_class ?? '', 'hero-archive'),
	])></div>
	@endif

	<div class="__wrapper c-wide relative z-10">
		<div @class(['__content relative flex flex-col justify-center w-full lg:w-216 z-20 pt-56 pb-62',
			'!pt-26 !pb-6 text-center mx-auto' => str_contains($section_class ?? '', 'hero-about'),
			'!pt-2 !pb-44' => str_contains($section_class ?? '', 'hero-archive'),
		])>
			@if (!empty($breadcrumbs))
			<nav class="__bread flex flex-wrap items-center gap-2 mb-36 text-white" aria-label="Okruszki">
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
			<h1 data-gsap-element="header" class="text-h1 uppercase text-white m-header">
				{{ $g_hero['title'] }}
			</h1>
			@if (!empty($g_hero['text']))
			<div data-gsap-element="text" class="text-white">
				{!! $g_hero['text'] !!}
			</div>
			@endif

			<div class="inline-buttons m-btn">
				@if (!empty($g_hero['button1']))
				<x-button
					:href="$g_hero['button1']['url']"
					variant="primary"
					class="!rounded-none"
					data-gsap-element="btn">
					{{ $g_hero['button1']['title'] }}
				</x-button>
				@endif

				@if (!empty($g_hero['button2']))
				<x-button
					:href="$g_hero['button2']['url']"
					variant="white"
					class="!rounded-none"
					data-gsap-element="btn">
					{{ $g_hero['button2']['title'] }}
				</x-button>
				@endif
			</div>
		</div>
	</div>

</section>

@endif
