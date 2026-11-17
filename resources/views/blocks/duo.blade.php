<!--- duo --->

@if (!empty($block->preview))
@include('blocks.previews.preview-duo')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-duo relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-wide flex flex-col gap-16">
		<div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 lg:gap-26">
			@if (!empty($g_duo['subtitle']) || !empty($g_duo['header']))
			<div class="__top">
				@if (!empty($g_duo['subtitle']))
				<div class="__title flex items-center gap-2 m-title" data-gsap-element="header">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
						<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
					</svg>
					<p class="text-h7 uppercase text-primary-400">{{ $g_duo['subtitle'] }}</p>
				</div>
				@endif
				@if (!empty($g_duo['header']))
				<h2 data-gsap-element="header" class="text-h1 uppercase">{{ $g_duo['header'] }}</h2>
				@endif
			</div>
			@endif
			@if (!empty($g_duo['text']))
			<div data-gsap-element="txt" class="__txt lg:w-1/2 2xl:w-187 shrink-0">
				{!! $g_duo['text'] !!}
			</div>
			@endif
		</div>

		@if (!empty($r_duo))
		<div class="__cards grid grid-cols-1 md:grid-cols-2 gap-8" data-gsap-element="stagger">
			@foreach ($r_duo as $item)
			@php($url = $item['button']['url'] ?? '')
			<a @if ($url) href="{{ $url }}" @endif class="__card relative flex text-white items-end h-122.5 p-6 lg:p-10 overflow-hidden">
				@if (!empty($item['image']['ID']))
				<figure class="__img absolute inset-0 m-0 after:absolute after:inset-0 after:bg-linear-to-t after:from-black/80 after:to-transparent">
					{!! wp_get_attachment_image($item['image']['ID'], 'large', false, ['class' => 'w-full h-full object-cover', 'alt' => '']) !!}
				</figure>
				@endif
				<div class="relative z-10 flex items-end justify-between gap-10 w-full">
					<div class="__txt text-white lg:w-136">
						@if (!empty($item['header']))
						<p class="text-h4 uppercase text-white m-header">{{ $item['header'] }}</p>
						@endif
						@if (!empty($item['text']))
						<div>{!! $item['text'] !!}</div>
						@endif
					</div>
					@if ($url)
					<span class="__arrow text-secondary flex items-center justify-center w-14 h-14 shrink-0 bg-white" aria-hidden="true">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="11" viewBox="0 0 16 11" fill="none">
							<path d="M10.5 0.5L15.5 5.5M15.5 5.5L10.5 10.5M15.5 5.5H0.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</span>
					@endif
				</div>
			</a>
			@endforeach
		</div>
		@endif
	</div>

</section>

@endif
