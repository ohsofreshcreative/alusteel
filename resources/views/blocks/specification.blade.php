<!--- specification --->

@if (!empty($block->preview))
@include('blocks.previews.preview-specification')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-specification relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-wide flex flex-col gap-16">
		@if (!empty($g_specification['subtitle']) || !empty($g_specification['header']))
		<div class="__top">
			@if (!empty($g_specification['subtitle']))
			<div class="__title flex items-center gap-2 m-title" data-gsap-element="header">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
					<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
				</svg>
				<p class="text-h7 uppercase !text-primary-400">{{ $g_specification['subtitle'] }}</p>
			</div>
			@endif
			@if (!empty($g_specification['header']))
			<h2 data-gsap-element="header" class="text-h1 uppercase">{{ $g_specification['header'] }}</h2>
			@endif
		</div>
		@endif

		@if (!empty($r_specification))
		<div class="__table grid grid-cols-1 lg:grid-cols-2 lg:gap-8" data-gsap-element="txt">
			@foreach (array_chunk($r_specification, (int) ceil(count($r_specification) / 2)) as $column)
			<dl class="__col m-0">
				@foreach ($column as $row)
				<div class="__row flex flex-col sm:flex-row gap-2 sm:gap-8 px-6 py-4 bg-white border-b border-secondary-50 last:border-b-0">
					<dt class="sm:w-68 shrink-0">{{ $row['label'] ?? '' }}</dt>
					<dd class="font-bold m-0">{{ $row['value'] ?? '' }}</dd>
				</div>
				@endforeach
			</dl>
			@endforeach
		</div>
		@endif
	</div>

</section>

@endif
