<footer @class([
	'l-footer footer bg-linear-to-b from-black to-primary-900 overflow-hidden relative z-10',
	'-smt' => !get_field('no_footer_margin') && !is_singular('post') && !is_category(),
])>

	<figure data-gsap-element="img" class="absolute bottom-0 inset-x-0 mix-blend-color-dodge opacity-40 z-0 m-0">
		<picture>
			<img src="{{ get_template_directory_uri() }}/resources/images/bottom.svg" alt="" class="block w-full h-auto" />
		</picture>
	</figure>

	<figure data-gsap-element="img" class="absolute inset-0 w-full h-full z-0 m-0">
		<picture class="w-full h-full">
			<img src="/wp-content/uploads/2026/11/0bf8f2caf9eb1e0b.jpg" alt="bg" class="w-full h-full object-cover opacity-5" />
		</picture>
	</figure>

	@if (!empty($footer_cta))
	<div class="c-wide -spt relative z-10">
		<div class="__cta relative overflow-hidden">

			@if (!empty($footer_cta['image']['ID']))
			<figure class="__img absolute inset-0 m-0 after:absolute after:inset-0 after:bg-primary-dark/60 after:content-['']">
				{!! wp_get_attachment_image($footer_cta['image']['ID'], 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => '', 'loading' => 'lazy']) !!}
			</figure>
			@endif

			<div class="__content relative z-10 md:w-1/2 px-6 py-14 md:px-16">
				@if (!empty($footer_cta['header']))
				<p class="text-h2 uppercase text-white m-header">{{ $footer_cta['header'] }}</p>
				@endif

				@if (!empty($footer_cta['txt']))
				<div class="__txt text-white">{!! $footer_cta['txt'] !!}</div>
				@endif

				@if (!empty($footer_cta['button1']) || !empty($footer_cta['button2']))
				<div class="inline-buttons m-btn">
					@if (!empty($footer_cta['button1']))
					<x-button :href="$footer_cta['button1']['url']" variant="primary">
						{{ $footer_cta['button1']['title'] }}
					</x-button>
					@endif

					@if (!empty($footer_cta['button2']))
					<x-button :href="$footer_cta['button2']['url']" variant="white">
						{{ $footer_cta['button2']['title'] }}
					</x-button>
					@endif
				</div>
				@endif
			</div>
		</div>
	</div>
	@endif

	<div class="c-wide __wrapper relative z-10">
		<div class="__widgets grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 md:gap-10 footer-py">

			<div class="__col lg:col-span-2 w-full sm:w-10/12">
				@if (!empty($logo_footer))
				<a href="{{ home_url('/') }}" class="block max-w-[180px] m-header">
					<img src="{{ $logo_footer['url'] }}" alt="{{ $logo_footer['alt'] ?: get_bloginfo('name') }}" class="w-full h-auto object-contain" />
				</a>
				@endif

				@if (!empty($footer_contact['header']))
				<p class="text-h6 uppercase text-white">{{ $footer_contact['header'] }}</p>
				@endif

				@if (!empty(array_filter((array) $socials)))
				<div class="__socials flex items-center gap-4 text-primary m-btn">
					@if (!empty($socials['facebook']))
					<a href="{{ $socials['facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook" class="hover:text-white">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="M13.5 21v-7.5h2.5l.4-3h-2.9V8.6c0-.9.3-1.5 1.5-1.5h1.5V4.4c-.3 0-1.2-.1-2.2-.1-2.2 0-3.8 1.4-3.8 3.9v2.3H8v3h2.5V21h3z" />
						</svg>
					</a>
					@endif

					@if (!empty($socials['instagram']))
					<a href="{{ $socials['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram" class="hover:text-white">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
							<rect x="3" y="3" width="18" height="18" rx="5" />
							<circle cx="12" cy="12" r="4" />
							<circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" />
						</svg>
					</a>
					@endif

					@if (!empty($socials['youtube']))
					<a href="{{ $socials['youtube'] }}" target="_blank" rel="noopener" aria-label="YouTube" class="hover:text-white">
						<svg xmlns="http://www.w3.org/2000/svg" width="28" height="24" viewBox="0 0 28 20" fill="currentColor" aria-hidden="true">
							<path d="M27.4 3.1A3.5 3.5 0 0 0 25 .6C22.8 0 14 0 14 0S5.2 0 3 .6A3.5 3.5 0 0 0 .6 3.1C0 5.3 0 10 0 10s0 4.7.6 6.9A3.5 3.5 0 0 0 3 19.4c2.2.6 11 .6 11 .6s8.8 0 11-.6a3.5 3.5 0 0 0 2.4-2.5c.6-2.2.6-6.9.6-6.9s0-4.7-.6-6.9zM11.2 14.3V5.7l7.3 4.3-7.3 4.3z" />
						</svg>
					</a>
					@endif
				</div>
				@endif
			</div>

			@for ($i = 1; $i <= 2; $i++)
			@if (is_active_sidebar('sidebar-footer-' . $i))
			<div class="__col">@php(dynamic_sidebar('sidebar-footer-' . $i))</div>
			@endif
			@endfor

			@if (!empty($footer_contact['phone']) || !empty($footer_contact['email']) || !empty($footer_contact['address']))
			<div class="__col">
				<p class="widget-title text-h5 uppercase text-white !block !mb-4">Kontakt</p>
				<ul class="flex flex-col gap-4">
					@if (!empty($footer_contact['phone']))
					<li>
						<a href="tel:{{ str_replace(' ', '', $footer_contact['phone']) }}" class="inline-flex items-center gap-4">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="shrink-0" aria-hidden="true">
								<path d="M21 16.5v3a1.5 1.5 0 0 1-1.6 1.5A18 18 0 0 1 3 4.6 1.5 1.5 0 0 1 4.5 3h3a1.5 1.5 0 0 1 1.5 1.3c.1 1 .4 1.9.7 2.8a1.5 1.5 0 0 1-.3 1.6L8.1 10a14 14 0 0 0 5.9 5.9l1.3-1.3a1.5 1.5 0 0 1 1.6-.3c.9.3 1.8.6 2.8.7a1.5 1.5 0 0 1 1.3 1.5z" />
							</svg>
							{{ $footer_contact['phone'] }}
						</a>
					</li>
					@endif

					@if (!empty($footer_contact['email']))
					<li>
						<a href="mailto:{{ $footer_contact['email'] }}" class="inline-flex items-center gap-4">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="shrink-0" aria-hidden="true">
								<rect x="3" y="5" width="18" height="14" rx="2" />
								<path d="m3 7 9 6 9-6" />
							</svg>
							{{ $footer_contact['email'] }}
						</a>
					</li>
					@endif

					@if (!empty($footer_contact['address']))
					<li class="flex items-start gap-4 !text-white">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="shrink-0" aria-hidden="true">
							<path d="M12 21s-7-6.1-7-11.5a7 7 0 0 1 14 0C19 14.9 12 21 12 21z" />
							<circle cx="12" cy="9.5" r="2.5" />
						</svg>
						<div class="__txt">{!! $footer_contact['address'] !!}</div>
					</li>
					@endif
				</ul>
			</div>
			@endif

		</div>
	</div>

	<div class="footer-bottom pt-10 pb-50 text-white border-t border-dotted border-primary/40">
		<div class="c-main flex flex-col md:flex-row items-center justify-center gap-4 md:gap-10">
			<p>Copyright ©{{ date('Y') }} {{ get_bloginfo('name') }}. All rights reserved.</p>

			@if (get_privacy_policy_url())
			<span class="hidden md:block w-px h-8 bg-primary" aria-hidden="true"></span>
			<a href="{{ get_privacy_policy_url() }}">Polityka prywatności</a>
			@endif

			<span class="hidden md:block w-px h-8 bg-primary" aria-hidden="true"></span>
			<p class="flex items-center gap-2">Designed &amp; Developed by
				<a target="_blank" rel="nofollow" href="https://www.ohsofresh.pl" title="OhSoFresh"><img class="oh" src="{{ get_template_directory_uri() }}/resources/images/ohsofresh.svg" alt="OhSoFresh"></a>
			</p>
		</div>
	</div>

</footer>
