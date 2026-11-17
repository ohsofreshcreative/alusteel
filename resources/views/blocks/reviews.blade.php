<!--- reviews -->

@if (!empty($block->preview))
@include('blocks.previews.preview-reviews')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-reviews relative -smt' ,
	'overflow-hidden' => !empty($photo),
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>
	@if (!empty($photo))
	{{-- Układ ze zdjęciem i strzałkami (makieta „Referencje”); domyślny układ niżej bez zmian --}}
	<div class="__wrapper c-wide flex flex-col gap-10">
		@if (!empty($subtitle) || !empty($header))
		<div class="__top">
			@if (!empty($subtitle))
			<div class="__title flex items-center gap-2 m-title" data-gsap-element="header">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true" class="text-primary-400">
					<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="currentColor" />
				</svg>
				<p class="text-h7 uppercase text-primary-400">{{ $subtitle }}</p>
			</div>
			@endif
			@if (!empty($header))
			<h2 data-gsap-element="header" class="text-h2 uppercase">{{ $header }}</h2>
			@endif
		</div>
		@endif

		@if (!empty($r_reviews))
		<div class="__slider relative" data-gsap-element="card">
			<div class="swiper reviews-photo-swiper overflow-visible!">
				<div class="swiper-wrapper">
					@foreach ($r_reviews as $card)
					<div class="swiper-slide">
						<div class="__card flex flex-col lg:flex-row lg:items-center gap-9 h-full p-6 lg:p-10 bg-white">
							@if (!empty($card['image']['ID']))
							<figure class="__img m-0 lg:w-1/2 aspect-16/9 shrink-0">
								{!! wp_get_attachment_image($card['image']['ID'], 'large', false, ['class' => 'w-full h-full object-cover']) !!}
							</figure>
							@endif
							<div class="__content relative grow">
								<svg class="__quote absolute top-0 right-12 hidden lg:block" xmlns="http://www.w3.org/2000/svg" width="82" height="64" viewBox="0 0 82 64" fill="none" aria-hidden="true">
									<path opacity="0.2" d="M38.6133 1V33.0078L38.46 33.251L20.0547 62.5322L19.7607 63H1.64258L2.39551 61.541L15.8076 35.5684H2.28418V1H38.6133ZM80.2842 1V33.0029L80.1348 33.2451L62.04 62.5254L61.7461 63H43.1934L43.9668 61.5332L57.6689 35.5684H43.8516V1H80.2842Z" fill="white" stroke="#474747" stroke-width="2" />
								</svg>
								<div>
									@if (!empty($card['header']) || !empty($card['subtitle']))
									<div class="m-header">
										@if (!empty($card['header']))
										<p class="text-h4 uppercase m-header">{{ $card['header'] }}</p>
										@endif
										@if (!empty($card['subtitle']))
										<p class="__sub text-secondary-300">{{ $card['subtitle'] }}</p>
										@endif
									</div>
									@endif
									@if (!empty($card['txt']))
									<div class="__txt">{!! $card['txt'] !!}</div>
									@endif
								</div>
								@if (!empty($card['link']['url']))
								<div class="inline-buttons m-btn">
									<x-button :href="$card['link']['url']" variant="white" class="!rounded-none" :target="$card['link']['target'] ?: null">
										{{ $card['link']['title'] }}
									</x-button>
								</div>
								@endif
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			@if (count($r_reviews) > 1)
			<button type="button" class="__prev bg-primary-600 text-white [&.swiper-button-disabled]:bg-primary-100 [&.swiper-button-disabled]:cursor-default absolute top-1/2 cursor-pointer transition-colors duration-200 ease-out left-2 lg:left-8 z-10 flex items-center justify-center w-16 h-16 -translate-y-1/2" aria-label="Poprzednia opinia">
				<svg class="rotate-180" xmlns="http://www.w3.org/2000/svg" width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true">
					<path d="M13.8137 4.51252L9.35909 0.173983C9.23907 0.0610831 9.07832 -0.00138872 8.91147 2.34296e-05C8.74461 0.00143557 8.585 0.0666186 8.46702 0.181533C8.34903 0.296447 8.2821 0.451899 8.28065 0.614406C8.2792 0.776913 8.34334 0.933474 8.45926 1.05037L11.8276 4.33092H0.63637C0.467594 4.33092 0.305731 4.39622 0.186388 4.51246C0.0670459 4.62869 0 4.78634 0 4.95072C0 5.1151 0.0670459 5.27274 0.186388 5.38898C0.305731 5.50521 0.467594 5.57051 0.63637 5.57051H11.8276L8.45926 8.85106C8.39848 8.90824 8.35 8.97663 8.31665 9.05225C8.2833 9.12786 8.26575 9.20919 8.26501 9.29149C8.26428 9.37378 8.28038 9.4554 8.31238 9.53157C8.34437 9.60774 8.39163 9.67694 8.45138 9.73513C8.51113 9.79333 8.58218 9.83935 8.66039 9.87051C8.73859 9.90168 8.82239 9.91736 8.90689 9.91664C8.99138 9.91593 9.07489 9.89883 9.15253 9.86635C9.23017 9.83386 9.30039 9.78665 9.35909 9.72745L13.8137 5.38891C13.933 5.27268 14 5.11506 14 4.95072C14 4.78637 13.933 4.62875 13.8137 4.51252Z" fill="currentColor" />
				</svg>
			</button>
			<button type="button" class="__next bg-primary-600 text-white [&.swiper-button-disabled]:bg-primary-100 [&.swiper-button-disabled]:cursor-default absolute top-1/2 cursor-pointer transition-colors duration-200 ease-out right-2 lg:-right-8 z-10 flex items-center justify-center w-16 h-16 -translate-y-1/2" aria-label="Następna opinia">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true">
					<path d="M13.8137 4.51252L9.35909 0.173983C9.23907 0.0610831 9.07832 -0.00138872 8.91147 2.34296e-05C8.74461 0.00143557 8.585 0.0666186 8.46702 0.181533C8.34903 0.296447 8.2821 0.451899 8.28065 0.614406C8.2792 0.776913 8.34334 0.933474 8.45926 1.05037L11.8276 4.33092H0.63637C0.467594 4.33092 0.305731 4.39622 0.186388 4.51246C0.0670459 4.62869 0 4.78634 0 4.95072C0 5.1151 0.0670459 5.27274 0.186388 5.38898C0.305731 5.50521 0.467594 5.57051 0.63637 5.57051H11.8276L8.45926 8.85106C8.39848 8.90824 8.35 8.97663 8.31665 9.05225C8.2833 9.12786 8.26575 9.20919 8.26501 9.29149C8.26428 9.37378 8.28038 9.4554 8.31238 9.53157C8.34437 9.60774 8.39163 9.67694 8.45138 9.73513C8.51113 9.79333 8.58218 9.83935 8.66039 9.87051C8.73859 9.90168 8.82239 9.91736 8.90689 9.91664C8.99138 9.91593 9.07489 9.89883 9.15253 9.86635C9.23017 9.83386 9.30039 9.78665 9.35909 9.72745L13.8137 5.38891C13.933 5.27268 14 5.11506 14 4.95072C14 4.78637 13.933 4.62875 13.8137 4.51252Z" fill="currentColor" />
				</svg>
			</button>
			@endif
		</div>
		@endif
	</div>
	@else
	<div class="__wrapper c-main">
		<div class="__content">
			@if(!empty($header))
			<div data-gsap-element="header" class="__wrapper text-primary block w-full md:w-1/2 pb-10">
				<h3 class="text-">{{ $header }}</h3>
			</div>
			@endif

			<div class="swiper reviews-swiper !overflow-visible">
				<div data-gsap-element="swiper" class="swiper-wrapper">
					@foreach($r_reviews as $card)
					<div class="swiper-slide">
						<div class="__card relative bg-white radius h-full">

							<div class="relative z-10 flex flex-col gap-4 h-full pt-16 p-8 mt-6">
								@if(!empty($card['txt']))
								<div class="review-content-wrapper">
									<div class=""><img src="/wp-content/uploads/2026/07/quote.svg" alt="" /></div>
									<p class="text-h5 mt-14 block">{!! $card['header'] !!}</p>
									<div class="__txt mt-4 line-clamp-6">{!! $card['txt'] !!}</div>
									<button class="btn-more hidden underline text-primary font-bold mt-2 cursor-pointer">Zobacz całość</button>
								</div>
								@endif

								<div class="flex flex-col lg:flex-row items-start lg:items-center gap-2 mt-auto">
									<img src="{{ $card['image']['url'] }}" alt="{{ $card['image']['alt'] ?? '' }}" class="border border-gray-200 rounded-lg w-36 h-16 object-contain p-4" />
									<div class="__who">
										<b class="font-header text-h6">{{ $card['name'] }}</b>
										<p class="text-gray-500">{{ $card['position'] }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>

				<div data-gsap-element="arrows" class="w-full z-10 flex flex-col md:flex-row items-center pointer-events-none gap-4 mt-16">
					<div class="flex items-center pointer-events-none gap-4 order-2 md:order-1">
						<div class="__prev rounded-full bg-secondary h-14 w-14 flex items-center justify-center pointer-events-auto cursor-pointer transition-all duration-400 shrink-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
								<path d="M0.270429 5.31498C0.270706 5.31469 0.270937 5.31435 0.27126 5.31406L5.08882 0.281803C5.44973 -0.0951806 6.03348 -0.0937777 6.39273 0.285093C6.75194 0.663916 6.75055 1.27664 6.38964 1.65367L3.15514 5.03226L12.078 5.03226C12.5872 5.03226 13 5.46552 13 6C13 6.53448 12.5872 6.96774 12.078 6.96774L3.15518 6.96774L6.3896 10.3463C6.75051 10.7234 6.75189 11.3361 6.39269 11.7149C6.03344 12.0938 5.44963 12.0951 5.08877 11.7182L0.271213 6.68594C0.270936 6.68565 0.270706 6.68531 0.270383 6.68502C-0.0907122 6.30673 -0.08956 5.69202 0.270429 5.31498Z" fill="#FFF" />
							</svg>
						</div>
						<div class="__next rounded-full bg-secondary h-14 w-14 flex items-center justify-center pointer-events-auto cursor-pointer transition-all duration-300 shrink-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
								<path d="M12.7296 5.31498C12.7293 5.31469 12.7291 5.31435 12.7287 5.31406L7.91118 0.281803C7.55027 -0.0951806 6.96652 -0.0937777 6.60727 0.285093C6.24806 0.663916 6.24945 1.27664 6.61036 1.65367L9.84486 5.03226L0.921985 5.03226C0.412773 5.03226 0 5.46552 0 6C0 6.53448 0.412773 6.96774 0.921985 6.96774L9.84482 6.96774L6.6104 10.3463C6.24949 10.7234 6.24811 11.3361 6.60731 11.7149C6.96657 12.0938 7.55037 12.0951 7.91123 11.7182L12.7288 6.68594C12.7291 6.68565 12.7293 6.68531 12.7296 6.68502C13.0907 6.30673 13.0896 5.69202 12.7296 5.31498Z" fill="#FFF" />
							</svg>
						</div>
					</div>

					{{-- Pasek postępu --}}
					<div class="__progress w-full md:flex-1 h-1 bg-white rounded-full overflow-hidden md:ml-10 order-1 md:order-2">
						<div class="__progress-fill h-full bg-secondary rounded-full w-0 transition-all duration-300"></div>
					</div>
				</div>

			</div>

			<!-- <div class="mt-10">
				<img src="/wp-content/uploads/2025/12/google-1.svg" />
				<a class="!underline">Sprawdź wszystkie opinie</a>
			</div> -->
		</div>
	</div>
	@endif
	<div id="review-popup" class="review-popup fixed inset-0 bg-black/50 bg-opacity-70 z-999 flex items-center justify-center p-4 hidden">
		<div class="review-popup__content bg-white rounded-lg shadow-xl p-8 md:p-12 max-w-3xl w-full relative">
			<button class="review-popup__close absolute top-4 right-4 text-gray-500 hover:text-gray-800 transition-colors">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</button>
			<div id="review-popup-text" class="prose max-w-none mb-4">
			</div>
			<div class="flex items-center gap-4">
				<img src="{{ get_template_directory_uri() }}/resources/images/stars.svg" class="h-5" alt="" />
				<b id="review-popup-author" class="font-header text-h6">
				</b>
			</div>
		</div>
	</div>
</section>

@endif
