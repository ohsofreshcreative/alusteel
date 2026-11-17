<!--- highlight --->

@if (!empty($block->preview))
@include('blocks.previews.preview-highlight')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-highlight relative -smt overflow-hidden' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	'bg-secondary-900' => blank($background) || $background === 'none',
	])>

	@if (!empty($g_highlight['image']['ID']))
	<figure @class(['__img absolute inset-0 m-0 after:absolute after:inset-0 after:from-black/80 after:from-20% after:to-transparent', 'after:bg-linear-to-r' => empty($flip), 'after:bg-linear-to-l' => !empty($flip)])>
		{!! wp_get_attachment_image($g_highlight['image']['ID'], 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => '']) !!}
	</figure>
	@endif

	<div class="__wrapper c-wide py-30 relative z-10 flex grow shrink-0 basis-full">
		<div @class(['__content flex flex-col gap-8 w-full lg:w-200', 'lg:ml-auto' => !empty($flip)])>
			<div>
				@if (!empty($g_highlight['subtitle']) || !empty($g_highlight['header']))
				<div class="__top">
					@if (!empty($g_highlight['subtitle']))
					<div class="__title m-title flex items-center gap-2" data-gsap-element="header">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
							<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
						</svg>
						<p class="text-h7 uppercase text-primary-400">{{ $g_highlight['subtitle'] }}</p>
					</div>
					@endif
					@if (!empty($g_highlight['header']))
					<h2 data-gsap-element="header" class="text-h1 uppercase text-white m-header">{{ $g_highlight['header'] }}</h2>
					@endif
				</div>
				@endif
				@if (!empty($g_highlight['text']))
				<div data-gsap-element="txt" class="__txt text-white">
					{!! $g_highlight['text'] !!}
				</div>
				@endif
			</div>
			@if (!empty($r_highlight))
			<ul class="__list flex flex-col gap-4" data-gsap-element="stagger">
				@foreach ($r_highlight as $item)
				<li @class(['__item pl-4 border-l border-dashed border-primary-600 text-white', 'py-2 lg:w-164' => !empty($item['text'])])>
					@if (!empty($item['header']))
					<p @class(['text-white', 'text-h5 uppercase m-header' => !empty($item['text'])])>{{ $item['header'] }}</p>
					@endif
					@if (!empty($item['text']))
					<div class="[&_p]:!text-white">{!! $item['text'] !!}</div>
					@endif
				</li>
				@endforeach
			</ul>
			@endif
			@if (!empty($g_highlight['button']['url']))
			<div class="inline-buttons">
				<x-button :href="$g_highlight['button']['url']" variant="primary" class="!rounded-none" data-gsap-element="btn">
					{{ $g_highlight['button']['title'] }}
				</x-button>
			</div>
			@endif
		</div>
	</div>

</section>

@endif
