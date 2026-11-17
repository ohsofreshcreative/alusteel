<!--- docs --->

@if (!empty($block->preview))
@include('blocks.previews.preview-docs')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-docs relative -smt overflow-hidden' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	'bg-secondary-900' => blank($background) || $background === 'none',
	])>

	@if (!empty($g_docs['image']['ID']))
	<figure class="__img absolute inset-0 m-0 after:absolute after:inset-0 after:bg-linear-to-r after:from-secondary-900 after:to-secondary-900/70 after:opacity-90">
		{!! wp_get_attachment_image($g_docs['image']['ID'], 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => '']) !!}
	</figure>
	@endif

	<div class="__wrapper c-wide py-30 relative z-10 flex flex-col gap-10">
		@if (!empty($g_docs['subtitle']) || !empty($g_docs['header']))
		<div class="__top">
			@if (!empty($g_docs['subtitle']))
			<div class="__title m-title flex items-center gap-2" data-gsap-element="header">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
					<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
				</svg>
				<p class="text-h7 uppercase text-primary-400">{{ $g_docs['subtitle'] }}</p>
			</div>
			@endif
			@if (!empty($g_docs['header']))
			<h2 data-gsap-element="header" class="text-h1 uppercase text-white">{{ $g_docs['header'] }}</h2>
			@endif
		</div>
		@endif

		@if (!empty($r_docs))
		<ul class="__items grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" data-gsap-element="stagger">
			@foreach ($r_docs as $item)
			@php
			$fileUrl = $item['file']['url'] ?? '';
			$fileInfo = $item['info'] ?: (!empty($item['file']) ? strtoupper($item['file']['subtype'] ?? '') . ' - ' . size_format($item['file']['filesize'] ?? 0, 1) : '');
			@endphp
			<li class="__item">
				<a @if ($fileUrl) href="{{ $fileUrl }}" download @endif class="__card group flex items-center gap-12 h-full p-6 border border-white/20 !text-white transition-colors duration-300 hover:border-primary-600 hover:bg-white/5">
					<svg class="shrink-0 text-primary-600" xmlns="http://www.w3.org/2000/svg" width="30" height="34" viewBox="0 0 30 34" fill="none" aria-hidden="true">
						<path d="M21.0 0H3.5C1.567 0 0 1.567 0 3.5V30.5C0 32.433 1.567 34 3.5 34H26.5C28.433 34 30 32.433 30 30.5V9L21 0ZM21 3.121L26.879 9H22.5C21.672 9 21 8.328 21 7.5V3.121ZM27 30.5C27 30.776 26.776 31 26.5 31H3.5C3.224 31 3 30.776 3 30.5V3.5C3 3.224 3.224 3 3.5 3H18V7.5C18 9.985 20.015 12 22.5 12H27V30.5Z" fill="currentColor" />
						<path d="M6 18H9.2C10.7 18 11.6 18.9 11.6 20.2C11.6 21.5 10.7 22.4 9.2 22.4H7.6V25H6V18ZM7.6 19.3V21.1H9C9.6 21.1 10 20.8 10 20.2C10 19.6 9.6 19.3 9 19.3H7.6ZM12.8 18H15.2C17.3 18 18.6 19.4 18.6 21.5C18.6 23.6 17.3 25 15.2 25H12.8V18ZM14.4 19.4V23.6H15.1C16.3 23.6 17 22.8 17 21.5C17 20.2 16.3 19.4 15.1 19.4H14.4ZM19.8 18H24V19.4H21.4V20.9H23.7V22.3H21.4V25H19.8V18Z" fill="currentColor" />
					</svg>
					<span class="__txt flex flex-col grow">
						@if (!empty($item['header']))
						<span class="m-header !text-lg">{{ $item['header'] }}</span>
						@endif
						@if ($fileInfo)
						<span class="__info opacity-50">{{ $fileInfo }}</span>
						@endif
					</span>
					<svg class="shrink-0 transition duration-300 group-hover:translate-y-1 group-hover:text-primary-600" xmlns="http://www.w3.org/2000/svg" width="32" height="38" viewBox="10 10 37 41" fill="none" aria-hidden="true">
						<path d="M27.4395 42.8614C27.7325 43.1544 28.1163 43.3009 28.5 43.3009C28.8837 43.3009 29.2676 43.1544 29.5605 42.8614L40.874 31.5479C41.4599 30.9625 41.4599 30.0123 40.874 29.4268C40.2881 28.8409 39.3388 28.8409 38.7529 29.4268L30 38.1797V11.5C30 10.6714 29.3281 10 28.5 10C27.6719 10 27 10.6714 27 11.5V38.1797L18.2471 29.4268C17.6612 28.8409 16.7119 28.8409 16.126 29.4268C15.5401 30.0122 15.5401 30.9624 16.126 31.5479L27.4395 42.8614ZM45.5 47.8702H11.5C10.6719 47.8702 10 48.5416 10 49.3702C10 50.1988 10.6719 50.8702 11.5 50.8702H45.5C46.3281 50.8702 47 50.1988 47 49.3702C47 48.5416 46.3281 47.8702 45.5 47.8702Z" fill="currentColor" />
					</svg>
				</a>
			</li>
			@endforeach
		</ul>
		@endif
	</div>

</section>

@endif
