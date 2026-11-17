<!--- cta -->

@if (!empty($block->preview))
@include('blocks.previews.preview-cta')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-cta relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-wide">
		<div class="__inside relative overflow-hidden grid grid-cols-1 md:grid-cols-2 items-center gap-6">

			@if (!empty($g_octa['image']['ID']))
			<figure class="__img absolute inset-0 m-0 after:absolute after:inset-0 after:bg-primary-900/60">
				{!! wp_get_attachment_image($g_octa['image']['ID'], 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => '']) !!}
			</figure>
			@endif

			<div class="__content relative z-10 w-full px-6 py-14 md:px-20">
				@if (!empty($g_octa['header']))
				<p data-gsap-element="header" class="block text-h2 uppercase text-white m-header">{{ $g_octa['header'] }}</p>
				@endif
				@if (!empty($g_octa['txt']))
				<div data-gsap-element="txt" class="text-white">{!! $g_octa['txt'] !!}</div>
				@endif

				@if (!empty($g_octa['button1']) || !empty($g_octa['button2']))
				<div class="inline-buttons m-btn">
					@if (!empty($g_octa['button1']))
					<x-button
						:href="$g_octa['button1']['url']"
						variant="primary"
						class="!rounded-none"
						data-gsap-element="btn">
						{{ $g_octa['button1']['title'] }}
					</x-button>
					@endif

					@if (!empty($g_octa['button2']))
					<x-button
						:href="$g_octa['button2']['url']"
						variant="white"
						class="!rounded-none"
						data-gsap-element="btn">
						{{ $g_octa['button2']['title'] }}
					</x-button>
					@endif
				</div>
				@endif
			</div>

			@if ($form)
			<div data-gsap-element="form" class="relative z-10 bg-white radius p-10 m-6">
				<h4 class="text-primary mb-4">{!! $g_octa['title'] !!}</h4>
				{!! do_shortcode($g_octa['shortcode']) !!}
			</div>
			@endif
		</div>
	</div>

</section>

@endif
