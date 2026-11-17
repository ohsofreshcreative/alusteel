<!--- reach --->

@if (!empty($block->preview))
@include('blocks.previews.preview-reach')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-reach relative -smt overflow-hidden' ,
	'bg-black' => empty($background) || $background === 'none',
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	@if (!empty($g_reach['image']['ID']))
	<figure class="__img absolute inset-0 m-0 after:absolute after:inset-0 after:bg-linear-to-t after:from-primary-dark after:to-transparent">
		{!! wp_get_attachment_image($g_reach['image']['ID'], 'full', false, ['class' => 'w-full h-full object-cover opacity-20', 'alt' => '']) !!}
	</figure>
	@endif

	<div class="__wrapper relative z-10 flex flex-col lg:flex-row">
		<div class="__col bg-secondary-900 flex items-center lg:w-5/12 shrink-0 px-6 py-26 2xl:pl-52">
			<div class="flex flex-col gap-12 text-white">
				@if (!empty($g_reach['header']) || !empty($g_reach['text']))
				<div class="__top">
					@if (!empty($g_reach['header']))
					<h2 data-gsap-element="header" class="text-h1 uppercase text-white m-header">{{ $g_reach['header'] }}</h2>
					@endif
					@if (!empty($g_reach['text']))
					<div data-gsap-element="txt" class="__address pl-6 border-l border-dashed border-primary-600">
						{!! $g_reach['text'] !!}
					</div>
					@endif
				</div>
				@endif
				@if (!empty($r_reach))
				<ul class="__contact flex flex-col gap-4" data-gsap-element="txt">
					@foreach ($r_reach as $item)
					@continue(empty($item['value']))
					<li>
						<a href="{{ ($item['type'] ?? '') === 'email' ? 'mailto:' . $item['value'] : 'tel:' . preg_replace('/[^0-9+]/', '', $item['value']) }}" class="flex items-center gap-4 !text-white">
							<svg class="__icon shrink-0 text-primary-600" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true">
								@if (($item['type'] ?? '') === 'email')
								<rect x="3" y="6" width="22" height="16" stroke="currentColor" stroke-width="1.5" /><path d="M3.5 7L14 15.5L24.5 7" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
								@else
								<path d="M8.6 3.5L10.9 8.2C11.2 8.8 11 9.6 10.5 10L8.9 11.3C10.2 14.2 12.6 16.6 15.5 17.9L16.8 16.3C17.2 15.8 18 15.6 18.6 15.9L23.3 18.2C24 18.5 24.3 19.3 24.1 20L23.4 22.6C23.1 23.8 22 24.6 20.8 24.5C11.6 23.9 4.1 16.4 3.5 7.2C3.4 6 4.2 4.9 5.4 4.6L8 3.9C8.2 3.7 8.4 3.6 8.6 3.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" /><path d="M16 3.5C20.4 4.1 23.9 7.6 24.5 12M15.5 7.5C17.9 8 19.8 9.9 20.3 12.3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
								@endif
							</svg>
							{{ $item['value'] }}
						</a>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
		</div>

		<div class="__form flex justify-center grow px-6 py-26">
			<div class="w-full 2xl:w-164">
				@if (!empty($g_reach['form_header']))
				<h3 data-gsap-element="header" class="text-h4 uppercase text-white m-header">{{ $g_reach['form_header'] }}</h3>
				@endif
				@if (!empty($g_reach['shortcode']))
				<div data-gsap-element="form">
					{!! do_shortcode($g_reach['shortcode']) !!}
				</div>
				@endif
			</div>
		</div>
	</div>

</section>

@endif
