<!--- utv --->

@if (!empty($block->preview))
@include('blocks.previews.preview-utv')
@else

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-utv relative -smt overflow-hidden' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	@if (!empty($g_utv['image']['ID']))
	<figure class="__img absolute inset-0 m-0 after:absolute after:inset-0 after:bg-linear-to-r after:from-black/80 after:from-20% after:to-transparent">
		{!! wp_get_attachment_image($g_utv['image']['ID'], 'full', false, ['class' => 'w-full h-full object-cover']) !!}
	</figure>
	@endif

	<div class="__wrapper c-wide relative z-10 py-52">
		<div class="__content lg:w-1/2">
			@if (!empty($g_utv['subtitle']))
			<div class="__title flex items-center gap-2 m-title" data-gsap-element="header">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none" aria-hidden="true">
					<path d="M10.5821 5.17459C12.4408 7.49359 14.5666 10.3342 13.8617 13.5162C13.6873 14.3268 13.3349 15.0919 12.834 15.753C11.8212 17.0773 10.289 17.8953 8.63807 18C9.72508 17.3287 10.1517 15.944 9.62862 14.7658C8.9497 13.2648 7.62154 12.1691 6.99827 10.6344C6.375 12.1691 5.04684 13.2648 4.36792 14.7658C3.84482 15.9407 4.26775 17.3216 5.35106 17.9962C3.71126 17.884 2.19761 17.066 1.19221 15.7527C0.695081 15.0998 0.346346 14.3493 0.168269 13.5459C-0.414192 10.9529 0.594912 8.4392 1.97501 6.29244C2.0455 7.07294 2.231 7.84256 2.53521 8.56303C2.78378 7.30184 3.22155 6.08568 3.83369 4.95658C5.00974 2.70512 6.94262 0.945611 9.2836 0C8.86437 1.68859 9.2465 3.47474 10.315 4.84063C10.404 4.94945 10.493 5.06239 10.5821 5.17459Z" fill="#FFA000" />
				</svg>
				<p class="text-h7 uppercase !text-primary-400">{{ $g_utv['subtitle'] }}</p>
			</div>
			@endif
			@if (!empty($g_utv['header']))
			<h2 data-gsap-element="header" class="text-h1 uppercase text-white m-header">{{ $g_utv['header'] }}</h2>
			@endif
			@if (!empty($g_utv['text']))
			<div data-gsap-element="txt" class="__txt text-white">
				{!! $g_utv['text'] !!}
			</div>
			@endif
			@if (!empty($g_utv['button']['url']))
			<div class="inline-buttons m-btn">
				<x-button :href="$g_utv['button']['url']" variant="primary" class="!rounded-none" data-gsap-element="btn">
					{{ $g_utv['button']['title'] }}
				</x-button>
			</div>
			@endif
		</div>
	</div>

	@if (!empty($g_utv['video']['url']))
	<a href="{{ $g_utv['video']['url'] }}" class="__play absolute z-10 left-2/3 top-1/2 -translate-y-1/2 hidden lg:block" aria-label="{{ $g_utv['video']['title'] ?: 'Odtwórz wideo' }}">
		<svg xmlns="http://www.w3.org/2000/svg" width="67" height="67" viewBox="0 0 67 67" fill="none" aria-hidden="true">
			<circle cx="33.5" cy="33.5" r="31.5" fill="#F1F4F7" fill-opacity="0.8" stroke="#F7F7FA" stroke-width="4" />
			<path d="M42.9061 29.3887L34.1465 22.988C33.3838 22.4305 32.4809 22.0945 31.5381 22.0172C30.5952 21.9399 29.6493 22.1244 28.8053 22.5501C27.9614 22.9758 27.2524 23.6262 26.7572 24.4289C26.262 25.2317 25.9999 26.1554 26 27.0976V39.8989C25.9982 40.8415 26.2591 41.766 26.7537 42.5695C27.2484 43.3731 27.9573 44.0242 28.8015 44.4502C29.6457 44.8762 30.5921 45.0605 31.5353 44.9825C32.4785 44.9046 33.3815 44.5674 34.1436 44.0085L42.9081 37.6078C43.5564 37.1347 44.0837 36.516 44.4471 35.802C44.8106 35.088 45 34.2987 45 33.4982C45 32.6977 44.8106 31.9085 44.4471 31.1945C44.0837 30.4805 43.5564 29.8618 42.9081 29.3887H42.9061Z" fill="white" />
			<path d="M43.6857 29.0311L34.004 22.0739C33.1611 21.4679 32.1631 21.1027 31.121 21.0187C30.0789 20.9347 29.0334 21.1352 28.1006 21.5979C27.1678 22.0607 26.3843 22.7676 25.8369 23.6401C25.2896 24.5127 24.9999 25.5168 25 26.5408V40.4554C24.998 41.4798 25.2864 42.4848 25.8331 43.3582C26.3798 44.2316 27.1633 44.9393 28.0964 45.4024C29.0295 45.8655 30.0755 46.0658 31.118 45.981C32.1605 45.8963 33.1585 45.5298 34.0008 44.9223L43.6879 37.965C44.4045 37.4507 44.9872 36.7782 45.389 36.0022C45.7907 35.2261 46 34.3682 46 33.4981C46 32.628 45.7907 31.7701 45.389 30.994C44.9872 30.2179 44.4045 29.5455 43.6879 29.0311H43.6857ZM41.7983 35.4445L32.1166 42.4018C31.7493 42.6661 31.3143 42.8256 30.86 42.8623C30.4057 42.8991 29.9499 42.8118 29.5433 42.6102C29.1366 42.4085 28.795 42.1003 28.5564 41.7199C28.3178 41.3395 28.1916 40.9018 28.1918 40.4554V26.5408C28.1869 26.0937 28.3112 25.6544 28.5502 25.2735C28.7893 24.8926 29.1335 24.5857 29.543 24.3881C29.8897 24.2138 30.2735 24.122 30.6633 24.1203C31.1856 24.1228 31.6934 24.289 32.1124 24.5944L41.7941 31.5517C42.1063 31.7758 42.3602 32.0688 42.5353 32.407C42.7103 32.7452 42.8015 33.119 42.8015 33.4981C42.8015 33.8772 42.7103 34.251 42.5353 34.5892C42.3602 34.9274 42.1063 35.2204 41.7941 35.4445H41.7983Z" fill="#DA1500" />
		</svg>
	</a>
	@endif

</section>

@endif
