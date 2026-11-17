<!--- references --->

@if (!empty($block->preview))
@include('blocks.previews.preview-references')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-references relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-wide flex flex-col gap-12">
		@if (!empty($g_references['subtitle']) || !empty($g_references['header']) || !empty($g_references['text']))
		<div class="__top">
			@if (!empty($g_references['subtitle']))
			<div class="__title flex items-center gap-2 m-title" data-gsap-element="header">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
					<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
				</svg>
				<p class="text-h7 uppercase !text-primary-400">{{ $g_references['subtitle'] }}</p>
			</div>
			@endif
			@if (!empty($g_references['header']))
			<h2 data-gsap-element="header" class="text-h2 uppercase m-header">{{ $g_references['header'] }}</h2>
			@endif
			@if (!empty($g_references['text']))
			<div data-gsap-element="txt" class="__txt">
				{!! $g_references['text'] !!}
			</div>
			@endif
		</div>
		@endif

		@if (!empty($r_references))
		<ul class="__cards lightbox-gallery grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8" data-gsap-element="stagger">
			@foreach ($r_references as $item)
			@php
			$url = $item['file']['url'] ?? ($item['image']['url'] ?? '');
			// baguetteBox obsługuje tylko obrazy; inne pliki (np. PDF) otwieramy normalnie w nowej karcie
			$isImage = (bool) preg_match('/\.(gif|jpe?g|png|webp)$/i', $url);
			@endphp
			<li class="__card group">
				@if (!empty($item['image']['ID']))
				<figure class="__img m-img bg-secondary-50 overflow-hidden">
					@if ($url)
					<a href="{{ $url }}" @if (!$isImage) target="_blank" rel="noopener" @endif class="flex items-center justify-center h-91.75 py-6" aria-label="Powiększ: {{ $item['header'] ?? '' }}">
						{!! wp_get_attachment_image($item['image']['ID'], 'medium_large', false, ['class' => 'h-full w-auto object-contain transition-transform duration-300 group-hover:scale-105']) !!}
					</a>
					@else
					<div class="flex items-center justify-center h-91.75 py-6">
						{!! wp_get_attachment_image($item['image']['ID'], 'medium_large', false, ['class' => 'h-full w-auto object-contain']) !!}
					</div>
					@endif
				</figure>
				@endif
				<div class="__content">
					<div class="__txt">
						@if (!empty($item['header']))
						<p class="text-h5 uppercase">{{ $item['header'] }}</p>
						@endif
						@if (!empty($item['subtitle']))
						<p class="__sub !text-secondary-300">{{ $item['subtitle'] }}</p>
						@endif
					</div>
					@if ($url && !empty($g_references['more']))
					@if ($isImage && !empty($item['image']['ID']))
					{{-- Otwiera ten sam lightbox co miniatura (bez drugiego linku w galerii, żeby zdjęcia się nie dublowały) --}}
					<button type="button" x-data @click="$el.closest('.__card').querySelector('.__img a').click()" class="__link inline-flex !text-primary-600 items-center gap-6 text-h6 uppercase mt-4 cursor-pointer">
					@else
					<a href="{{ $url }}" target="_blank" rel="noopener" class="__link inline-flex !text-primary-600 items-center gap-6 text-h6 uppercase m-btn">
					@endif
						{{ $g_references['more'] }}
						<svg class="transition-transform duration-300 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none" aria-hidden="true">
						<path d="M15.7871 5.15717L10.6961 0.198838C10.5589 0.0698092 10.3752 -0.0015871 10.1845 2.67767e-05C9.99384 0.00164066 9.81143 0.0761355 9.67659 0.207466C9.54175 0.338797 9.46526 0.516456 9.4636 0.702178C9.46195 0.887901 9.53525 1.06683 9.66773 1.20042L13.5172 4.94963H0.72728C0.534393 4.94963 0.349407 5.02426 0.213015 5.15709C0.0766239 5.28993 0 5.4701 0 5.65796C0 5.84582 0.0766239 6.02599 0.213015 6.15883C0.349407 6.29167 0.534393 6.3663 0.72728 6.3663H13.5172L9.66773 10.1155C9.59827 10.1808 9.54286 10.259 9.50475 10.3454C9.46663 10.4318 9.44657 10.5248 9.44573 10.6188C9.44489 10.7129 9.46329 10.8062 9.49986 10.8932C9.53643 10.9803 9.59043 11.0594 9.65872 11.1259C9.727 11.1924 9.8082 11.245 9.89758 11.2806C9.98696 11.3162 10.0827 11.3341 10.1793 11.3333C10.2759 11.3325 10.3713 11.3129 10.46 11.2758C10.5488 11.2387 10.629 11.1847 10.6961 11.1171L15.7871 6.15875C15.9234 6.02592 16 5.84579 16 5.65796C16 5.47014 15.9234 5.29 15.7871 5.15717Z" fill="currentColor" />
					</svg>
					@if ($isImage && !empty($item['image']['ID']))
					</button>
					@else
					</a>
					@endif
					@endif
				</div>
			</li>
			@endforeach
		</ul>
		@endif
	</div>

</section>

@endif
