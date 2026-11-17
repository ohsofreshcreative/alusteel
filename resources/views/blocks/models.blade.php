<!--- models --->

@if (!empty($block->preview))
@include('blocks.previews.preview-models')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-models relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-wide flex flex-col xl:flex-row gap-14">
		<div class="__col xl:w-90 shrink-0">
			@if (!empty($g_models['subtitle']) || !empty($g_models['header']))
			<div class="__top">
				@if (!empty($g_models['subtitle']))
				<div class="__title m-title flex items-center gap-2" data-gsap-element="header">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
						<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
					</svg>
					<p class="text-h7 uppercase text-primary-400">{{ $g_models['subtitle'] }}</p>
				</div>
				@endif
				@if (!empty($g_models['header']))
				<h2 data-gsap-element="header" class="text-h2 uppercase m-header">{{ $g_models['header'] }}</h2>
				@endif
			</div>
			@endif
			@if (!empty($g_models['text']))
			<div data-gsap-element="txt" class="__txt">
				{!! $g_models['text'] !!}
			</div>
			@endif
			@if (!empty($g_models['button']['url']))
			<a href="{{ $g_models['button']['url'] }}" class="__link m-btn inline-flex !text-primary-600 items-center gap-6 text-h6 uppercase" @if (!empty($g_models['button']['target'])) target="{{ $g_models['button']['target'] }}" @endif data-gsap-element="btn">
				{{ $g_models['button']['title'] }}
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" fill="none" aria-hidden="true">
						<path d="M15.7871 5.15717L10.6961 0.198838C10.5589 0.0698092 10.3752 -0.0015871 10.1845 2.67767e-05C9.99384 0.00164066 9.81143 0.0761355 9.67659 0.207466C9.54175 0.338797 9.46526 0.516456 9.4636 0.702178C9.46195 0.887901 9.53525 1.06683 9.66773 1.20042L13.5172 4.94963H0.72728C0.534393 4.94963 0.349407 5.02426 0.213015 5.15709C0.0766239 5.28993 0 5.4701 0 5.65796C0 5.84582 0.0766239 6.02599 0.213015 6.15883C0.349407 6.29167 0.534393 6.3663 0.72728 6.3663H13.5172L9.66773 10.1155C9.59827 10.1808 9.54286 10.259 9.50475 10.3454C9.46663 10.4318 9.44657 10.5248 9.44573 10.6188C9.44489 10.7129 9.46329 10.8062 9.49986 10.8932C9.53643 10.9803 9.59043 11.0594 9.65872 11.1259C9.727 11.1924 9.8082 11.245 9.89758 11.2806C9.98696 11.3162 10.0827 11.3341 10.1793 11.3333C10.2759 11.3325 10.3713 11.3129 10.46 11.2758C10.5488 11.2387 10.629 11.1847 10.6961 11.1171L15.7871 6.15875C15.9234 6.02592 16 5.84579 16 5.65796C16 5.47014 15.9234 5.29 15.7871 5.15717Z" fill="currentColor" />
					</svg>
			</a>
			@endif
		</div>

		@if (!empty($r_models))
		<div class="__cards grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 grow" data-gsap-element="stagger">
			@foreach ($r_models as $item)
			<div class="__card relative px-6 pt-10 pb-6 bg-white">
				@if (!empty($item['image']['ID']))
				<figure class="__img flex justify-center m-img h-52">
					{!! wp_get_attachment_image($item['image']['ID'], 'medium_large', false, ['class' => 'h-full w-auto object-contain']) !!}
				</figure>
				@endif
				<div class="__txt">
					@if (!empty($item['header']))
					<h3 class="text-h5 uppercase m-header">
						@if (!empty($item['button']['url']))
						<a href="{{ $item['button']['url'] }}" class="!text-inherit after:absolute after:inset-0">{{ $item['header'] }}</a>
						@else
						{{ $item['header'] }}
						@endif
					</h3>
					@endif
					@if (!empty($item['text']))
					<div class="__desc text-secondary-300">{!! $item['text'] !!}</div>
					@endif
					@if (!empty($item['r_params']))
					<ul class="__params flex flex-col gap-2 mt-4">
						@foreach ($item['r_params'] as $param)
						<li class="flex items-center gap-8 pr-10">
							@if (!empty($param['icon']['ID']))
							<span class="w-10 h-10 shrink-0">
								{!! wp_get_attachment_image($param['icon']['ID'], 'thumbnail', false, ['class' => 'w-full h-full', 'alt' => '']) !!}
							</span>
							@endif
							@if (!empty($param['label']))
							<p class="text-secondary-300">{{ $param['label'] }}</p>
							@endif
						</li>
						@endforeach
					</ul>
					@endif
				</div>
				@if (!empty($item['button']['url']))
				<span class="__arrow absolute right-9 bottom-9 text-primary-600" aria-hidden="true">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 17" fill="none" aria-hidden="true">
						<path d="M23.6806 7.73576L16.0442 0.298257C15.8384 0.104714 15.5628 -0.00238065 15.2768 4.01651e-05C14.9908 0.00246099 14.7171 0.114203 14.5149 0.311199C14.3126 0.508195 14.1979 0.774684 14.1954 1.05327C14.1929 1.33185 14.3029 1.60024 14.5016 1.80063L20.2758 7.42444H1.09092C0.80159 7.42444 0.52411 7.53638 0.319523 7.73564C0.114936 7.9349 0 8.20515 0 8.48694C0 8.76874 0.114936 9.03899 0.319523 9.23824C0.52411 9.4375 0.80159 9.54944 1.09092 9.54944H20.2758L14.5016 15.1733C14.3974 15.2713 14.3143 15.3885 14.2571 15.5181C14.1999 15.6478 14.1699 15.7872 14.1686 15.9283C14.1673 16.0693 14.1949 16.2093 14.2498 16.3398C14.3046 16.4704 14.3856 16.589 14.4881 16.6888C14.5905 16.7886 14.7123 16.8675 14.8464 16.9209C14.9804 16.9743 15.1241 17.0012 15.2689 17C15.4138 16.9987 15.557 16.9694 15.69 16.9137C15.8231 16.8581 15.9435 16.7771 16.0442 16.6756L23.6806 9.23813C23.8851 9.03888 24 8.76868 24 8.48694C24 8.20521 23.8851 7.935 23.6806 7.73576Z" fill="currentColor" />
					</svg>
				</span>
				@endif
			</div>
			@endforeach
		</div>
		@endif
	</div>

</section>

@endif
