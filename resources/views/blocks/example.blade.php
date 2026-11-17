<!--- example --->

@if (!empty($block->preview))
@include('blocks.previews.preview-example')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-example relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-wide flex flex-col gap-16">
		<div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
			@if (!empty($g_example['subtitle']) || !empty($g_example['header']))
			<div class="__top">
				@if (!empty($g_example['subtitle']))
				<div class="__title m-title flex items-center gap-2" data-gsap-element="header">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
						<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
					</svg>
					<p class="text-h7 uppercase text-primary-400">{{ $g_example['subtitle'] }}</p>
				</div>
				@endif
				@if (!empty($g_example['header']))
				<h2 data-gsap-element="header" class="text-h1 uppercase">{{ $g_example['header'] }}</h2>
				@endif
			</div>
			@endif
			@if (!empty($g_example['text']))
			<div data-gsap-element="txt" class="__txt lg:w-1/2 2xl:w-201 shrink-0">
				{!! $g_example['text'] !!}
			</div>
			@endif
		</div>

		<div class="flex flex-col gap-8">
			@if (!empty($r_example))
			<ul class="__cards grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-6" data-gsap-element="stagger">
				@foreach ($r_example as $item)
				<li class="__card flex flex-col items-center px-6 py-10 bg-white text-center">
					@if (!empty($item['image']['ID']))
					<figure class="__img flex items-center justify-center m-img h-31.5">
						{!! wp_get_attachment_image($item['image']['ID'], 'medium_large', false, ['class' => 'h-full w-auto object-contain', 'alt' => '']) !!}
					</figure>
					@endif
					@if (!empty($item['header']))
					<p>{{ $item['header'] }}</p>
					@endif
				</li>
				@endforeach
			</ul>
			@endif

			@if (!empty($g_example['extra_header']) || !empty($g_example['extra_text']))
			<div class="__extra flex flex-col lg:flex-row lg:items-center gap-6 lg:gap-20 px-6 lg:px-10 py-6 bg-white" data-gsap-element="txt">
				@if (!empty($g_example['extra_header']))
				<div class="flex items-center gap-6 shrink-0">
					<span class="__plus flex items-center justify-center w-12.5 h-12.5 shrink-0 rounded-full border border-primary-600 text-secondary-300" aria-hidden="true">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
							<path d="M8 0V16M0 8H16" stroke="currentColor" stroke-width="1.5" />
						</svg>
					</span>
					<p class="text-h6 uppercase lg:w-70">{{ $g_example['extra_header'] }}</p>
				</div>
				@endif
				@if (!empty($g_example['extra_text']))
				<div class="__list grow lg:flex lg:justify-end">
					{!! $g_example['extra_text'] !!}
				</div>
				@endif
			</div>
			@endif
		</div>
	</div>

</section>

@endif
