<!-- accordion -->

@if (!empty($block->preview))
@include('blocks.previews.preview-accordion')
@else

@php
	$isCover = !empty($cover) && !empty($g_accordion['image']['ID']);
	$accId = uniqid('acc');
@endphp

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-accordion relative -smt' ,
	'accordion-cover overflow-hidden' => $isCover,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	@if ($isCover)
	{{-- Wariant „Zdjęcie jako tło sekcji” (makieta „O nas”); domyślny render poniżej bez zmian --}}
	<figure class="__img absolute inset-0 m-0 after:absolute after:inset-0 after:bg-linear-to-r after:from-black/80 after:from-20% after:to-transparent">
		{!! wp_get_attachment_image($g_accordion['image']['ID'], 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => '']) !!}
	</figure>

	<div class="__wrapper c-wide relative z-10 py-30">
		<div class="__col flex flex-col gap-8 lg:w-200">
			<div class="__top lg:w-164">
				@if (!empty($g_accordion['subtitle']))
				<div class="__title m-title flex items-center gap-2" data-gsap-element="header">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
						<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
					</svg>
					<p class="text-h7 uppercase !text-primary-400">{{ $g_accordion['subtitle'] }}</p>
				</div>
				@endif
				@if (!empty($g_accordion['title']))
				<h2 data-gsap-element="header" class="text-h1 uppercase text-white m-header">{{ $g_accordion['title'] }}</h2>
				@endif
				@if (!empty($g_accordion['text']))
				<div data-gsap-element="txt" class="__txt text-white">{!! $g_accordion['text'] !!}</div>
				@endif
			</div>

			@if (!empty($r_accordion))
			<div data-gsap-element="accordion" class="accordion-wrapper flex flex-col">
				@foreach ($r_accordion as $item)
				<div class="accordion __tile w-full overflow-hidden !mb-0 border-b border-dashed border-primary-100">
					<input class="acc-check" type="radio" name="{{ $accId }}" id="{{ $accId }}-{{ $loop->index }}">
					<label class="accordion-label flex items-center justify-between gap-4 px-2 py-4 !mb-0 cursor-pointer" for="{{ $accId }}-{{ $loop->index }}">
						<span class="text-h6 uppercase text-white">{{ $item['title'] }}</span>
						<svg class="__arrow shrink-0 text-white transition-transform duration-300 ease-in-out" xmlns="http://www.w3.org/2000/svg" width="16" height="9" viewBox="0 0 16 9" fill="none" aria-hidden="true">
							<path d="M1 1L8 8L15 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</label>
					@if (!empty($item['text']))
					<div class="accordion-content text-white">
						{!! $item['text'] !!}
					</div>
					@endif
				</div>
				@endforeach
			</div>
			@endif
		</div>
	</div>
	@else
	<div class="c-main">
		<div class="__wrapper">
			<div class="grid grid-cols-1 lg:grid-cols-2 items-end gap-8 lg:gap-20 my-10">
				<div class="__col">
					<h4 data-gsap-element="header" class="m-header text-primary">{{ $g_accordion['title'] }}</h4>
					<div data-gsap-element="txt" class="">{!! $g_accordion['text'] !!}</div>
					@if (!empty($g_accordion['image']))
					<figure data-gsap-element="img" class="__img order1 h-full mt-8">
						<picture>
							<img class="object-cover img-md w-full radius-img" src="{{ $g_accordion['image']['url'] }}" alt="{{ $g_accordion['image']['alt'] ?? '' }}">
						</picture>
					</figure>
					@endif

					@if (!empty($g_accordion['button']))
					<a class="main-btn m-btn" href="{{ $g_accordion['button']['url'] }}">{{ $g_accordion['button']['title'] }}</a>
					@endif
				</div>

				<div class="__content order2">
					<div data-gsap-element="accordion" class="accordion-wrapper grid">
						@foreach ($r_accordion as $item)
						<div class="accordion w-full overflow-hidden !mb-4 rounded-2xl bg-white border border-secondary h-max">
							<input class="acc-check" type="radio" name="accordion-radio" id="check{{ $loop->index }}" {{ $loop->first ? 'checked' : '' }}>
							<label class="accordion-label flex items-center justify-between !text-primary text-h7 gap-4 p-4 !mb-0 cursor-pointer" for="check{{ $loop->index }}">
								{{ $item['title'] }}
								<x-icon.arrow-up class="__arrow text-secondary w-3 h-4 transition-transform duration-300 ease-in-out" />
							</label>
							<div class="accordion-content">
								{!! $item['text'] !!}
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
</section>

@endif
