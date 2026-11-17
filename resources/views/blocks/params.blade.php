<!--- params --->

@if (!empty($block->preview))
@include('blocks.previews.preview-params')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-params relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-wide grid grid-cols-1 lg:grid-cols-2 items-center gap-12">
		@if (!empty($g_params['gallery']))
		{{-- Miniatury przełączają zdjęcie główne (Alpine.js) --}}
		<div class="__gallery flex flex-col gap-5" x-data="{ active: 0 }" data-gsap-element="img">
			<div class="__main relative bg-white aspect-3/2">
				@foreach ($g_params['gallery'] as $image)
				<figure class="__img absolute inset-0 m-0" @if (!$loop->first) x-cloak @endif x-show="active === {{ $loop->index }}"
					x-transition:enter="transition-opacity ease-out duration-500"
					x-transition:enter-start="opacity-0"
					x-transition:enter-end="opacity-100"
					x-transition:leave="transition-opacity ease-in duration-500"
					x-transition:leave-start="opacity-100"
					x-transition:leave-end="opacity-0">
					{!! wp_get_attachment_image($image['ID'], 'large', false, ['class' => 'w-full h-full object-cover']) !!}
				</figure>
				@endforeach
			</div>
			@if (count($g_params['gallery']) > 1)
			<div class="__thumbs grid grid-cols-5 gap-6">
				@foreach ($g_params['gallery'] as $image)
				<button type="button" class="__thumb block h-24 bg-white cursor-pointer" :class="{ 'is-active': active === {{ $loop->index }} }" x-on:click="active = {{ $loop->index }}" aria-label="Pokaż zdjęcie {{ $loop->iteration }}">
					{!! wp_get_attachment_image($image['ID'], 'medium', false, ['class' => 'w-full h-full object-cover', 'alt' => '']) !!}
				</button>
				@endforeach
			</div>
			@endif
		</div>
		@endif

		<div class="__content">
			<div class="flex flex-col gap-10">
				@if (!empty($g_params['header']))
				<h2 data-gsap-element="header" class="text-h1 uppercase">{{ $g_params['header'] }}</h2>
				@endif
				@if (!empty($r_params))
				<ul class="__list flex flex-col gap-3.5" data-gsap-element="stagger">
					@foreach ($r_params as $item)
					<li class="__row flex items-center justify-between gap-6 pb-4 border-b border-dashed border-secondary-50">
						<div class="flex items-center text-lg gap-3.5">
							@if (!empty($item['icon']['ID']))
							<figure class="__img m-0 w-10 h-10 shrink-0">
								{!! wp_get_attachment_image($item['icon']['ID'], 'full', false, ['class' => 'w-full h-full object-contain', 'alt' => '']) !!}
							</figure>
							@endif
							@if (!empty($item['label']))
							<p>{{ $item['label'] }}</p>
							@endif
						</div>
						@if (!empty($item['value']))
						<p class="text-right !font-bold text-lg">{{ $item['value'] }}</p>
						@endif
					</li>
					@endforeach
				</ul>
				@endif
			</div>
			@if (!empty($g_params['button']['url']))
			<div class="inline-buttons m-btn">
				<x-button :href="$g_params['button']['url']" variant="primary" class="!rounded-none" data-gsap-element="btn">
					{{ $g_params['button']['title'] }}
				</x-button>
			</div>
			@endif
		</div>
	</div>

</section>

@endif
