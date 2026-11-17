<!--- whyus --->

@if (!empty($block->preview))
@include('blocks.previews.preview-whyus')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-whyus relative -smt py-30 overflow-hidden' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	'bg-primary-dark' => !filled($background) || $background === 'none',
	])>

	@if (!empty($g_whyus['video']))
	<video class="__bg absolute inset-0 w-full h-full object-cover opacity-15" autoplay loop muted playsinline aria-hidden="true">
		<source src="{{ $g_whyus['video'] }}" type="video/mp4">
	</video>
	@endif

	<figure data-gsap-element="img" class="absolute inset-0 w-full h-full z-0 m-0">
		<picture class="w-full h-full">
			<img src="/wp-content/uploads/2026/11/0bf8f2caf9eb1e0b.jpg" alt="bg" class="w-full h-full object-cover opacity-5" />
		</picture>
	</figure>

	<div class="__wrapper mx-auto w-full max-w-362 px-6 relative z-10 flex flex-col gap-16">
		<div class="__top flex flex-col items-center text-center max-w-xl mx-auto">
			@if (!empty($g_whyus['subtitle']))
			<div class="__title m-title flex items-center gap-2" data-gsap-element="header">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
					<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
				</svg>
				<p class="text-h7 uppercase !text-primary-400">{{ $g_whyus['subtitle'] }}</p>
			</div>
			@endif
			@if (!empty($g_whyus['header']))
			<h2 data-gsap-element="header" class="text-h1 uppercase text-white">{{ $g_whyus['header'] }}</h2>
			@endif
		</div>

		<div x-data="{ active: 0 }" class="__content flex flex-col lg:flex-row lg:items-center lg:justify-center gap-20">
			<div class="__col flex flex-col gap-16 lg:w-103">
				@if (!empty($g_whyus['title']) || !empty($g_whyus['text']))
				<div class="__txt">
					@if (!empty($g_whyus['title']))
					<p data-gsap-element="header" class="text-h4 uppercase text-white block !mb-2">{{ $g_whyus['title'] }}</p>
					@endif
					@if (!empty($g_whyus['text']))
					<div data-gsap-element="txt" class="text-white">
						{!! $g_whyus['text'] !!}
					</div>
					@endif
				</div>
				@endif

				@if (!empty($r_whyus))
				<div class="__list flex flex-col gap-5" data-gsap-element="stagger">
					@foreach ($r_whyus as $item)
					<button
						type="button"
						class="__point flex items-center gap-6 text-left cursor-pointer transition-opacity"
						@click="active = {{ $loop->index }}"
						:class="active === {{ $loop->index }} ? '' : 'opacity-50'"
						:aria-pressed="active === {{ $loop->index }}">
						@if (!empty($item['icon']['ID']))
						<span class="__icon w-10 h-10 shrink-0">
							{!! wp_get_attachment_image($item['icon']['ID'], 'thumbnail', false, ['class' => 'w-full h-full', 'alt' => '']) !!}
						</span>
						@endif
						@if (!empty($item['header']))
						<span class="text-h6 uppercase text-white">{{ $item['header'] }}</span>
						@endif
					</button>
					@endforeach
				</div>
				@endif
			</div>

			@if (!empty($r_whyus))
			<div class="__col grid lg:w-170" data-gsap-element="card">
				@foreach ($r_whyus as $item)
				<div
					class="__card flex flex-col md:flex-row lg:h-124 bg-secondary-700 [grid-area:1/1]"
					x-show="active === {{ $loop->index }}"
					x-transition:enter="transition ease-out duration-500"
					x-transition:enter-start="opacity-0 translate-y-4"
					x-transition:enter-end="opacity-100 translate-y-0"
					x-transition:leave="transition ease-in duration-300"
					x-transition:leave-start="opacity-100"
					x-transition:leave-end="opacity-0"
					@if (!$loop->first) x-cloak @endif>
					@if (!empty($item['image']['ID']))
					<figure class="__img m-0 h-80 md:h-auto md:w-1/2">
						{!! wp_get_attachment_image($item['image']['ID'], 'large', false, ['class' => 'w-full h-full object-cover']) !!}
					</figure>
					@endif
					<div class="__txt flex flex-col justify-between p-10 md:w-1/2">
						<p class="text-h1 text-white text-right m-header">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
						@if (!empty($item['text']))
						<div class="text-white">{!! $item['text'] !!}</div>
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