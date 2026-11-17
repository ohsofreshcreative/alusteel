<!--- bar --->

@if (!empty($block->preview))
@include('blocks.previews.preview-bar')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-bar relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	'bg-secondary-900' => !filled($background) || $background === 'none',
	])>

	@if (!empty($r_bar))
	<div class="__wrapper c-wide py-14">
		<ul class="__items grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-10" data-gsap-element="stagger">
			@foreach ($r_bar as $item)
			<li class="__item flex items-center gap-6">
				@if (!empty($item['icon']['ID']))
				<figure class="__img m-0 w-10 h-10 shrink-0">
					{!! wp_get_attachment_image($item['icon']['ID'], 'full', false, ['class' => 'w-full h-full object-contain', 'alt' => '']) !!}
				</figure>
				@endif
				@if (!empty($item['header']))
				<p class="text-white">{{ $item['header'] }}</p>
				@endif
			</li>
			@endforeach
		</ul>
	</div>
	@endif

</section>

@endif
