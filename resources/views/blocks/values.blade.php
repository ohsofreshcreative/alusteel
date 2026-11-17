<!--- values --->

@if (!empty($block->preview))
@include('blocks.previews.preview-values')
@else

@php
	$valuesImage = collect($values)->pluck('image')->filter()->first();
	$noImage = empty($valuesImage['ID']);
	$split = !empty($split) && $noImage;
@endphp

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-values relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	{{-- Bez zdjęcia: nagłówek na pół szerokości, kafelki na całą szerokość (makieta „O nas”); ze zdjęciem bez zmian --}}
	<div @class(['__wrapper c-wide grid grid-cols-1 relative z-20', 'lg:grid-cols-2 items-center gap-18' => !$noImage])>
		@if (!empty($valuesImage['ID']))
		<figure data-gsap-element="img" class="__img m-0 h-80 lg:h-140">
			{!! wp_get_attachment_image($valuesImage['ID'], 'large', false, ['class' => 'w-full h-full object-cover']) !!}
		</figure>
		@endif

		<div @class(['__content flex flex-col', 'gap-10' => !$noImage, 'gap-16' => $noImage])>
			@if (!empty($g_values['subtitle']) || !empty($g_values['header']) || !empty($g_values['text']))
			<div @class(['__top', 'lg:w-1/2' => $noImage && !$split, 'flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between' => $split])>
				{{-- Wariant „split” (makieta UTV): nadtytuł i nagłówek po lewej, treść po prawej --}}
				@if ($split)
				<div class="lg:w-1/2 2xl:w-163">
				@endif
				@if (!empty($g_values['subtitle']))
				<div class="__title flex items-center gap-2 m-title" data-gsap-element="header">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
						<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
					</svg>
					<p class="text-h7 uppercase !text-primary-400">{{ $g_values['subtitle'] }}</p>
				</div>
				@endif
				@if (!empty($g_values['header']))
				<h2 data-gsap-element="header" @class(['uppercase', 'text-h1 m-header' => !$split, 'text-h2' => $split])>{{ $g_values['header'] }}</h2>
				@endif
				@if ($split)
				</div>
				@endif
				@if (!empty($g_values['text']))
				<div data-gsap-element="txt" @class(['__txt', 'lg:w-5/12 2xl:w-163' => $split])>
					{!! $g_values['text'] !!}
				</div>
				@endif
			</div>
			@endif

			@if (!empty($values))
			<div @class(['__cards grid grid-cols-2 lg:grid-cols-4', 'gap-10' => $noImage])>
				@foreach ($values as $slide)
				<div @class([
					'__card',
					'lg:pl-4 lg:border-l lg:border-dashed lg:border-black/30'=> !$noImage && !$loop->first,
					'lg:pr-10 lg:border-r lg:border-dashed' => $noImage && !$loop->last,
					'lg:border-black/30' => $noImage && !$loop->last && !$split,
					'lg:border-secondary-200' => $noImage && !$loop->last && $split,
					])>
					@if (!empty($slide['icon']['ID']))
					<span @class(['__icon block', 'w-10 h-10' => !$noImage, 'w-16 h-16' => $noImage])>
						{!! wp_get_attachment_image($slide['icon']['ID'], 'thumbnail', false, ['class' => 'w-full h-full', 'alt' => '']) !!}
					</span>
					@endif
					<div class="__txt mt-4">
						@if (!empty($slide['header']))
						<p @class(['uppercase', 'font-header text-h7' => !$noImage, 'text-h5' => $noImage])>{{ $slide['header'] }}</p>
						@endif
						@if (!empty($slide['opis']))
						<p>{{ $slide['opis'] }}</p>
						@endif
					</div>
				</div>
				@endforeach
			</div>
			@endif
		</div>
	</div>
</section>

@endif
