<!--- content -->

@if (!empty($block->preview))
@include('blocks.previews.preview-content')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-content relative -smt overflow-hidden' ,
	'content-features' => !empty($features),
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	@if (!empty($features))
	{{-- Układ z listą cech (wpis oferty); bez przełącznika render poniżej bez zmian --}}
	<div class="__wrapper c-wide relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8">
			@if (!empty($g_content['image']['ID']))
			<figure data-gsap-element="img" class="__img order1 m-0 aspect-10/7">
				{!! wp_get_attachment_image($g_content['image']['ID'], 'large', false, ['class' => 'w-full h-full object-cover']) !!}
			</figure>
			@endif

			<div class="__content order2 flex flex-col gap-8">
				<div class="2xl:w-154">
					<div class="__top">
						@if (!empty($g_content['subtitle']))
						<div class="__title flex items-center gap-2 m-title" data-gsap-element="header">
							<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
								<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
							</svg>
							<p class="text-h7 uppercase !text-primary-400">{{ $g_content['subtitle'] }}</p>
						</div>
						@endif
						@if (!empty($g_content['header']))
						<h2 data-gsap-element="header" class="text-h1 uppercase m-header">{{ $g_content['header'] }}</h2>
						@endif
					</div>
					@if (!empty($g_content['text']))
					<div data-gsap-element="txt" class="__txt">
						{!! $g_content['text'] !!}
					</div>
					@endif
				</div>

				@if (!empty($g_content['r_content']))
				<ul class="__cards flex flex-col gap-6" data-gsap-element="stagger">
					@foreach ($g_content['r_content'] as $item)
					<li class="__card flex items-center gap-6">
						@if (!empty($item['icon']['ID']))
						<figure class="__icon m-0 w-10 h-10 shrink-0">
							{!! wp_get_attachment_image($item['icon']['ID'], 'full', false, ['class' => 'w-full h-full object-contain', 'alt' => '']) !!}
						</figure>
						@endif
						<div>
							@if (!empty($item['header']))
							<p class="text-h6 uppercase m-header">{{ $item['header'] }}</p>
							@endif
							@if (!empty($item['text']))
							<div class="__desc">{!! $item['text'] !!}</div>
							@endif
						</div>
					</li>
					@endforeach
				</ul>
				@endif

				@if (!empty($g_content['button1']['url']))
				<div class="inline-buttons">
					<x-button :href="$g_content['button1']['url']" variant="primary" class="!rounded-none" data-gsap-element="btn">
						{{ $g_content['button1']['title'] }}
					</x-button>
				</div>
				@endif
			</div>
		</div>
	</div>
	@else
	@if ($bgshape)
		<img class="__bg-shape absolute inset-y-0 right-0 w-auto pointer-events-none" src="{{ get_template_directory_uri() }}/resources/images/bg-shape.svg" alt="">
	@endif

	<div class="__wrapper c-main relative">

		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20">
			@if (!empty($g_content['image']))
			<figure data-gsap-element="img" class="__img h-full order1">
				<picture>
					<img class="radius-img h-126 max-h-126 w-full object-cover" src="{{ $g_content['image']['url'] }}" alt="{{ $g_content['image']['alt'] ?? '' }}">
				</picture>
			</figure>
			@endif

			<div class="__content order2">
				<h2 data-gsap-element="header" class="text-h4 m-header text-primary">{{ $g_content['header'] }}</h2>

				<div data-gsap-element="txt" class="__txt">
					{!! $g_content['text'] !!}
				</div>

				@if (!empty($g_content['button1']) || !empty($g_content['button2']))
				<div class="inline-buttons m-btn">
					@if (!empty($g_content['button1']))
					<x-button
						:href="$g_content['button1']['url']"
						variant="primary"
						class=""
						data-gsap-element="btn">
						{{ $g_content['button1']['title'] }}
					</x-button>
					@endif

					@if (!empty($g_content['button2']))
					<x-button
						:href="$g_content['button2']['url']"
						variant="outline"
						class=""
						data-gsap-element="btn">
						{{ $g_content['button2']['title'] }}
					</x-button>
					@endif
				</div>
				@endif

			</div>

		</div>
	</div>
	@endif

</section>

@endif
