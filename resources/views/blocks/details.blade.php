<!--- details --->

@if (!empty($block->preview))
@include('blocks.previews.preview-details')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-details relative -smt overflow-hidden' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	'bg-black' => !filled($background) || $background === 'none',
	])>

	@if (!empty($g_details['image']['ID']))
	<figure class="__bg absolute inset-0 m-0 after:absolute after:inset-0 after:bg-linear-to-r after:from-black/24 after:from-30% after:to-black after:to-54%">
		{!! wp_get_attachment_image($g_details['image']['ID'], 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => '']) !!}
	</figure>
	@endif

	@if (!empty($r_details))
	{{-- Punkty na zdjęciu: pozycja z pól X/Y (%) przez atrybuty data-* (SCSS); poniżej lg zostaje sama lista --}}
	<div class="__points absolute inset-0 z-10 hidden lg:block" aria-hidden="true">
		@foreach ($r_details as $item)
		@if (isset($item['pos_x'], $item['pos_y']) && $item['pos_x'] !== '' && $item['pos_y'] !== '')
		<span class="__point absolute -translate-x-1/2 -translate-y-1/2 rounded-full flex items-center justify-center w-18 h-18 bg-white text-secondary text-h5" data-x="{{ (int) $item['pos_x'] }}" data-y="{{ (int) $item['pos_y'] }}">{{ $loop->iteration }}</span>
		@endif
		@endforeach
	</div>
	@endif

	<div class="__wrapper c-wide py-30 relative z-20 flex">
		<div class="__content flex flex-col gap-8 w-full lg:w-1/2 2xl:w-200 lg:ml-auto">
			<div>
				@if (!empty($g_details['subtitle']) || !empty($g_details['header']))
				<div class="__top">
					@if (!empty($g_details['subtitle']))
					<div class="__title flex items-center gap-2 m-title" data-gsap-element="header">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
							<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
						</svg>
						<p class="text-h7 uppercase !text-primary-400">{{ $g_details['subtitle'] }}</p>
					</div>
					@endif
					@if (!empty($g_details['header']))
					<h2 data-gsap-element="header" class="text-h1 uppercase text-white m-header">{{ $g_details['header'] }}</h2>
					@endif
				</div>
				@endif
				@if (!empty($g_details['text']))
				<div data-gsap-element="txt" class="__txt text-white">
					{!! $g_details['text'] !!}
				</div>
				@endif
			</div>
			@if (!empty($r_details))
			<ol class="__list flex flex-col gap-4" data-gsap-element="stagger">
				@foreach ($r_details as $item)
				<li class="flex items-center gap-2.5 text-white">
					<span class="__num flex items-center justify-center w-8 h-8 shrink-0 rounded-full bg-primary-600 text-white" aria-hidden="true">{{ $loop->iteration }}</span>
					<div class="flex flex-col">
						@if (!empty($item['header']))
						<p class="text-h6 uppercase text-white">{{ $item['header'] }}</p>
						@endif
						@if (!empty($item['text']))
						<div>{!! $item['text'] !!}</div>
						@endif
					</div>
				</li>
				@endforeach
			</ol>
			@endif
				@if (!empty($g_details['button']['url']))
				<div class="inline-buttons">
					<x-button :href="$g_details['button']['url']" variant="primary" class="!rounded-none" data-gsap-element="btn">
						{{ $g_details['button']['title'] }}
					</x-button>
				</div>
				@endif
		</div>
	</div>

</section>

@endif
