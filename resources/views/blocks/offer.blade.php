<!--- offer --->

@if (!empty($block->preview))
@include('blocks.previews.preview-offer')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-offer relative' ,
	'-smt pt-8 pb-30' => ($variant ?? '') !== 'tiles',
	'bg-secondary-900' => ($variant ?? '') !== 'tiles' && (!filled($background) || $background === 'none'),
	'offer-tiles z-10 -mt-21' => ($variant ?? '') === 'tiles',
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	@if (($variant ?? '') === 'tiles')
	{{-- Wariant kafli kategorii (archiwum oferty); domyślny render bloku poniżej bez zmian --}}
	<div class="__wrapper c-wide">
		@if (!empty($r_offer))
		<div class="__cards grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
			@foreach ($r_offer as $item)
			<a href="{{ $item['button']['url'] }}" data-gsap-element="card" @class(['__card relative flex items-center gap-4 h-42 p-4 pr-16 !text-white transition-colors duration-200 ease-out hover:bg-primary-700', 'bg-secondary-700' => empty($item['active']), 'is-active bg-primary-700' => !empty($item['active'])])>
				@if (!empty($item['image']['ID']))
				<figure class="__img flex items-center justify-center w-34 h-34 shrink-0 m-0">
					{!! wp_get_attachment_image($item['image']['ID'], 'medium', false, ['class' => 'w-full h-full object-contain', 'alt' => '']) !!}
				</figure>
				@endif
				<span class="text-h6 uppercase text-white">{{ $item['header'] }}</span>
				<svg class="absolute right-6 top-1/2 -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 17" fill="none" aria-hidden="true">
					<path d="M1 8.5H23M23 8.5L15.5 1M23 8.5L15.5 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</a>
			@endforeach
		</div>
		@endif
	</div>
	@else
	<div class="__wrapper c-wide flex flex-col gap-16">
		@if (!empty($g_offer['header']) || !empty($g_offer['text']))
		<div class="__top grid grid-cols-1 lg:grid-cols-2 gap-8">
			@if (!empty($g_offer['header']))
			<h2 data-gsap-element="header" class="text-h2 uppercase text-white">{{ $g_offer['header'] }}</h2>
			@endif
			@if (!empty($g_offer['text']))
			<div data-gsap-element="txt" class="__txt text-white">
				{!! $g_offer['text'] !!}
			</div>
			@endif
		</div>
		@endif

		@if (!empty($r_offer))
		<div class="__cards grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
			@foreach ($r_offer as $item)
			<div data-gsap-element="card" class="__card flex flex-col bg-secondary-700">
				@if (!empty($item['image']['ID']))
				<figure class="__img flex items-center justify-center h-60 px-16 py-6 m-img">
					{!! wp_get_attachment_image($item['image']['ID'], 'large', false, ['class' => 'w-full h-full object-contain']) !!}
				</figure>
				@endif
				<div class="__content flex flex-col justify-between grow px-8 pb-12">
					<div class="__txt">
						@if (!empty($item['header']))
						<p class="text-h5 uppercase text-white block !mb-2">{{ $item['header'] }}</p>
						@endif
						@if (!empty($item['text']))
						<div class="text-white">{!! $item['text'] !!}</div>
						@endif
					</div>
					@if (!empty($item['button']['url']))
					<x-button
						:href="$item['button']['url']"
						variant="underline"
						class="m-btn uppercase"
						data-gsap-element="btn">
						{{ $item['button']['title'] }}
					</x-button>
					@endif
				</div>
			</div>
			@endforeach
		</div>
		@endif
	</div>
	@endif

</section>

@endif
